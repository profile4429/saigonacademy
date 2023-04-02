<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class newsController extends Controller
{
    public function news()
    {
        return view('backend.news');
    }
    public function addNews(Request $request)
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
        $news_id = DB::table('news')->insertGetId($params);
        DB::table('newslocales')->insert([
            "vi" => ($language_id == 1) ? $news_id : null,
            "en" => ($language_id == 2) ? $news_id : null,
        ]);
        return redirect()->route('news');
    }
    public function deleteNews(Request $request)
    {
        try {
            $id = $request->id;
            $newslocales = DB::table('newslocales')->where('vi', $id)->orWhere('en', $id)->first();
            $language = null;
            $checknull = null;
            if ($newslocales) {
                if ($newslocales->vi == $id) {
                    $language = 'vi';
                } elseif ($newslocales->en == $id) {
                    $language = 'en';
                }
                DB::table('newslocales')->where('id', $newslocales->id)->update([
                    $language => $checknull
                ]);
                DB::table('news')->where('id', $request->id)
                    ->delete();
            } else {
                DB::table('news')->where('id', $request->id)
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
    public function showdataNews(Request $request)
    {
        $id = $request->id ?? 0;
        $news = [];
        if ($id > 0) {
            $news =  DB::table('news')->where('id', $id)->first();
        }
        return view('backend.newsedit')->with([
            'news' => $news
        ]);
    }

    public function editNews(Request $request)
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
        DB::table('news')->where('id', $id)->update($params);
        return redirect()->route('news');
    }
    public function showtransNews(Request $request)
    {
        $id = $request->id ?? 0;
        $news = [];
        if ($id > 0) {
            $news =  DB::table('news')->where('id', $id)->first();
        }
        return view('backend.newstrans')->with([
            'news' => $news
        ]);
    }
    public function transNews(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['image'] = $filename;
        }
        $news_id = $params['id'];
        unset($params['id']);
        $id = DB::table('news')->insertGetId($params);

        $language_id = $params['language_id'];
        $column = ($language_id == 1) ? 'vi' : 'en';
        $row = ($language_id == 1) ? 'en' : 'vi';

        $row_update = DB::table('newslocales')->where($row, $news_id)->first();

        DB::table('newslocales')->where('id', $row_update->id)->update([
            $column => $id,
        ]);
        return redirect()->route('news');
    }
}
