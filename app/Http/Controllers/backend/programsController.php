<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;

class programsController extends Controller
{
    public function programs()
    {
        return view('backend.programs');
    }
    public function addPrograms(Request $request)
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
        $programs_id = DB::table('programs')->insertGetId($params);
        DB::table('programslocales')->insert([
            "vi" => ($language_id == 1) ? $programs_id : null,
            "en" => ($language_id == 2) ? $programs_id : null,
        ]);
        return redirect()->route('programs');
    }
    public function deletePrograms(Request $request)
    {
        try {
            $id = $request->id;
            $programslocales = DB::table('programslocales')->where('vi', $id)->orWhere('en', $id)->first();
            $language = null;
            $checknull = null;
            if ($programslocales) {
                if ($programslocales->vi == $id) {
                    $language = 'vi';
                } elseif ($programslocales->en == $id) {
                    $language = 'en';
                }
                DB::table('programslocales')->where('id', $programslocales->id)->update([
                    $language => $checknull
                ]);
                DB::table('programslocales')->where('id', $programslocales->id)->delete();
                DB::table('programs')->where('id', $request->id)
                    ->delete();
            } else {
                DB::table('programs')->where('id', $request->id)
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
    public function showdataPrograms(Request $request)
    {
        $id = $request->id ?? 0;
        $programs = [];
        if ($id > 0) {
            $programs =  DB::table('programs')->where('id', $id)->first();
        }
        return view('backend.programsedit')->with([
            'programs' => $programs
        ]);
    }

    public function editPrograms(Request $request)
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
        DB::table('programs')->where('id', $id)->update($params);
        return redirect()->route('programs');
    }
    public function showtransPrograms(Request $request)
    {
        $id = $request->id ?? 0;
        $programs = [];
        if ($id > 0) {
            $programs =  DB::table('programs')->where('id', $id)->first();
        }
        return view('backend.programstrans')->with([
            'programs' => $programs
        ]);
    }
    public function transPrograms(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['image'] = $filename;
        }
        $programs_id = $params['id'];
        unset($params['id']);
        $id = DB::table('programs')->insertGetId($params);

        $language_id = $params['language_id'];
        $column = ($language_id == 1) ? 'vi' : 'en';
        $row = ($language_id == 1) ? 'en' : 'vi';

        $row_update = DB::table('programslocales')->where($row, $programs_id)->first();

        DB::table('programslocales')->where('id', $row_update->id)->update([
            $column => $id,
        ]);
        return redirect()->route('programs');
    }
}
