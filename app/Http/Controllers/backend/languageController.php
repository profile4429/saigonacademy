<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class languageController extends Controller
{
    public function language()
    {
        return view('backend.language');

    }
    public function addlanguage(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
         DB::table('languages')->insert($params);
         return redirect()->route('language');
    }
    public function deleteLanguage(Request $request)
    {
        try {
            DB::table('languages')->where('id', $request->id)
                ->delete();
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
}
