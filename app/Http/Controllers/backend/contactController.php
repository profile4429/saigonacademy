<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class contactController extends Controller
{
    public function contact()
    {

        return view('backend.contact');
    }
    public function addContact(Request $request)
    {
        $params = $request->all();
        $language_id = $params['language_id'];
        unset($params['_token']);
        $contact_id = DB::table('contact')->insertGetId($params);
        DB::table('contactlocales')->insert([
            "vi" => ($language_id == 1) ? $contact_id : null,
            "en" => ($language_id == 2) ? $contact_id : null,
        ]);
        return redirect()->route('contact');
    }
    public function deleteContact(Request $request)
    {
        try {
            $id = $request->id;
            $contactlocales = DB::table('contactlocales')->where('vi', $id)->orWhere('en', $id)->first();
            $language = null;
            $checknull = null;
            if ($contactlocales) {
                if ($contactlocales->vi == $id) {
                    $language = 'vi';
                } elseif ($contactlocales->en == $id) {
                    $language = 'en';
                }
                DB::table('contactlocales')->where('id', $contactlocales->id)->update([
                    $language => $checknull
                ]);
                DB::table('contact')->where('id', $request->id)
                    ->delete();
            } else {
                DB::table('contact')->where('id', $request->id)
                    ->delete();
            }
            $json = [
                'error' => 0,
                'messe' => "thanh cong"
            ];
        } catch (\Exception $e) {
            $json = [
                'error' => 1,
                'messe' => $e->getMessage()
            ];
        }
        return response()->json($json);
    }
    public function showdataContact(Request $request)
    {
        $id = $request->id ?? 0;
        $contact = [];
        if ($id > 0) {
            $contact =  DB::table('contact')->where('id', $id)->first();
        }
        return view('backend.contactedit')->with([
            'contact' => $contact
        ]);
    }

    public function editContact(Request $request)
    {
        $id = $request->id;
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['image'] = $filename;
        }
        DB::table('contact')->where('id', $id)->update($params);
        return redirect()->route('contact');
    }
    public function showtransContact(Request $request)
    {
        $id = $request->id ?? 0;
        $contact = [];
        if ($id > 0) {
            $contact =  DB::table('contact')->where('id', $id)->first();
        }
        return view('backend.contacttrans')->with([
            'contact' => $contact
        ]);
    }
    public function transContact(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        $contact_id = $params['id'];
        unset($params['id']);
        $id = DB::table('contact')->insertGetId($params);

        $language_id = $params['language_id'];
        $column = ($language_id == 1) ? 'vi' : 'en';
        $row = ($language_id == 1) ? 'en' : 'vi';

        $row_update = DB::table('contactlocales')->where($row, $contact_id)->first();

        DB::table('contactlocales')->where('id', $row_update->id)->update([
            $column => $id,
        ]);
        return redirect()->route('contact');
    }
}
