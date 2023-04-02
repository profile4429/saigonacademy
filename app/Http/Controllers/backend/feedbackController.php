<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class feedbackController extends Controller
{
    public function feedback()
    {
        return view('backend.feedback');
    }
    public function addFeedback(Request $request)
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
        $feedback_id = DB::table('feedback')->insertGetId($params);
        DB::table('feedbacklocales')->insert([
            "vi" => ($language_id == 1) ? $feedback_id : null,
            "en" => ($language_id == 2) ? $feedback_id : null,
        ]);
        return redirect()->route('feedback');
    }
    public function deleteFeedback(Request $request)
    {
        try {
            $id = $request->id;
            $feedbacklocales = DB::table('feedbacklocales')->where('vi', $id)->orWhere('en', $id)->first();
            $language = null;
            $checknull = null;
            if ($feedbacklocales) {
                if ($feedbacklocales->vi == $id) {
                    $language = 'vi';
                } elseif ($feedbacklocales->en == $id) {
                    $language = 'en';
                }
                DB::table('feedbacklocales')->where('id', $feedbacklocales->id)->update([
                    $language => $checknull
                ]);
                DB::table('feedbacklocales')->where('id', $feedbacklocales->id)->delete();
                DB::table('feedback')->where('id', $request->id)
                    ->delete();
            } else {
                DB::table('feedback')->where('id', $request->id)
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
    public function showdataFeedback(Request $request)
    {
        $id = $request->id ?? 0;
        $feedback= [];
        if ($id > 0) {
            $feedback=  DB::table('feedback')->where('id', $id)->first();
        }
        return view('backend.feedbackedit')->with([
            'feedback' => $feedback
        ]);
    }

    public function editFeedback(Request $request)
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
        DB::table('feedback')->where('id', $id)->update($params);
        return redirect()->route('feedback');
    }

    public function showtransFeedback(Request $request)
    {
        $id = $request->id ?? 0;
        $feedback = [];
        if ($id > 0) {
            $feedback =  DB::table('feedback')->where('id', $id)->first();
        }
        return view('backend.feedbacktrans')->with([
            'feedback' => $feedback
        ]);
    }
    public function transFeedback(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['image'] = $filename;
        }
        $feedback_id = $params['id'];
        unset($params['id']);
        $id = DB::table('feedback')->insertGetId($params);

        $language_id = $params['language_id'];
        $column = ($language_id == 1) ? 'vi' : 'en';
        $row = ($language_id == 1) ? 'en' : 'vi';

        $row_update = DB::table('feedbacklocales')->where($row, $feedback_id)->first();

        DB::table('feedbacklocales')->where('id', $row_update->id)->update([
            $column => $id,
        ]);
        return redirect()->route('feedback');
    }
}
