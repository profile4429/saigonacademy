<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class admissionsController extends Controller
{
    public function admissions()
    {
        return view('backend.admissions');
    }
    public function addAdmissions(Request $request)
    {
        $params = $request->all();
        $language_id = $params['language_id'];
        unset($params['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['image'] = $filename;
        }
        $admissions_id = DB::table('admissions')->insertGetId($params);
        DB::table('admissionslocales')->insert([
            "vi" => ($language_id == 1) ? $admissions_id : null,
            "en" => ($language_id == 2) ? $admissions_id : null,
        ]);
        return redirect()->route('admissions');
    }
    public function deleteAdmissions(Request $request)
    {
        try {
            $id = $request->id;
            $admissionslocales = DB::table('admissionslocales')->where('vi', $id)->orWhere('en', $id)->first();
            $language = null;
            $checknull = null;
            if ($admissionslocales) {
                if ($admissionslocales->vi == $id) {
                    $language = 'vi';
                } elseif ($admissionslocales->en == $id) {
                    $language = 'en';
                }
                DB::table('admissionslocales')->where('id', $admissionslocales->id)->update([
                    $language => $checknull
                ]);
                DB::table('admissions')->where('id', $request->id)
                    ->delete();
            } else {
                DB::table('admissions')->where('id', $request->id)
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
    public function showdataAdmissions(Request $request)
    {
        $id = $request->id ?? 0;
        $admissions = [];
        if ($id > 0) {
            $admissions =  DB::table('admissions')->where('id', $id)->first();
        }
        return view('backend.admissionsedit')->with([
            'admissions' => $admissions
        ]);
    }

    public function editAdmissions(Request $request)
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
        DB::table('admissions')->where('id', $id)->update($params);
        return redirect()->route('admissions');
    }

    public function showtransAdmissions(Request $request)
    {
        $id = $request->id ?? 0;
        $admissions = [];
        if ($id > 0) {
            $admissions =  DB::table('admissions')->where('id', $id)->first();
        }
        return view('backend.admissionstrans')->with([
            'admissions' => $admissions
        ]);
    }
    public function transAdmissions(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['image'] = $filename;
        }
        $admissions_id = $params['id'];
        unset($params['id']);
        $id = DB::table('admissions')->insertGetId($params);

        $language_id = $params['language_id'];
        $column = ($language_id == 1) ? 'vi' : 'en';
        $row = ($language_id == 1) ? 'en' : 'vi';

        $row_update = DB::table('admissionslocales')->where($row, $admissions_id)->first();

        DB::table('admissionslocales')->where('id', $row_update->id)->update([
            $column => $id,
        ]);
        return redirect()->route('admissions');
    }
}
