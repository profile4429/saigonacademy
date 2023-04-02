<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class introController extends Controller
{
    public function intro()
    {

        return view('backend.intro');
    }
    public function addIntro(Request $request)
    {
        $params = $request->all();
        $language_id = $params['language_id'];
        unset($params['_token']);
        $intro_id = DB::table('intro')->insertGetId($params);
        DB::table('introlocales')->insert([
            "vi" => ($language_id == 1) ? $intro_id : null,
            "en" => ($language_id == 2) ? $intro_id : null,
        ]);
        return redirect()->route('intro');
    }
    public function deleteIntro(Request $request)
    {

        try {
            $id = $request->id;
            $introlocales = DB::table('introlocales')->where('vi', $id)->orWhere('en', $id)->first();
            $language = null;
            $checknull = null;
            if ($introlocales) {
                if ($introlocales->vi == $id) {
                    $language = 'vi';
                } elseif ($introlocales->en == $id) {
                    $language = 'en';
                }
                DB::table('introlocales')->where('id', $introlocales->id)->update([
                    $language => $checknull
                ]);
                DB::table('intro')->where('id', $request->id)
                    ->delete();
            } else {
                DB::table('intro')->where('id', $request->id)
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
    public function showdataIntro(Request $request)
    {
        $id = $request->id ?? 0;
        $intro = [];
        if ($id > 0) {
            $intro =  DB::table('intro')->where('id', $id)->first();
        }
        return view('backend.introedit')->with([
            'intro' => $intro
        ]);
    }

    public function editIntro(Request $request)
    {
        $id = $request->id;
        $params = $request->all();
        unset($params['_token']);
        DB::table('intro')->where('id', $id)->update($params);
        return redirect()->route('intro');
    }

    public function showtransIntro(Request $request)
    {
        $id = $request->id ?? 0;
        $intro = [];
        if ($id > 0) {
            $intro =  DB::table('intro')->where('id', $id)->first();
        }
        return view('backend.introtrans')->with([
            'intro' => $intro
        ]);
    }
    public function transIntro(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        $intro_id = $params['id'];
        unset($params['id']);
        $id = DB::table('intro')->insertGetId($params);

        $language_id = $params['language_id'];
        $column = ($language_id == 1) ? 'vi' : 'en';
        $row = ($language_id == 1) ? 'en' : 'vi';

        $row_update = DB::table('introlocales')->where($row, $intro_id)->first();

        DB::table('introlocales')->where('id', $row_update->id)->update([
            $column => $id,
        ]);
        return redirect()->route('intro');
    }
}
