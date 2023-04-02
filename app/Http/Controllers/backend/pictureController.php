<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class pictureController extends Controller
{
    public function picture()
    {
        return view('backend.picture');
    }
    public function addPicture(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('slider')) {
            $image = $request->file('slider');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['slider'] = $filename;
        }
        DB::table('pictures')->insert($params);
        return redirect()->route('picture');
    }
    public function addPictureMembers(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        if ($request->hasFile('members')) {
            $image = $request->file('members');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->move('images', $filename);
            $params['members'] = $filename;
        }
        DB::table('pictures')->insert($params);
        return redirect()->route('picture');
    }
    public function deletePicture(Request $request)
    {
        try {
            DB::table('pictures')->where('id', $request->id)
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
    public function showdataPicture(Request $request)
    {
        $id = $request->id ?? 0;
        $picture = [];
        if ($id > 0) {
            $picture =  DB::table('pictures')->where('id', $id)->first();
        }
        return view('backend.pictureedit')->with([
            'picture' => $picture
        ]);
    }

}
