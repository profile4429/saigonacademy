<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class homecontroller extends Controller
{
    public function showlogin()
    {
        return view('backend.showlogin');
    }
    public function showregister()
    {
        return view('backend.showregister');
    }
    public function showHome()
    {
        return view('backend.layouts.adminHome');
    }
    public function dashboard()
    {
        return view('backend.dashboard');
    }
    public function checkLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $count = DB::table('admins')
            ->where('username', '=', $username)
            ->where('password', '=', $password)
            ->count();
        if ($count > 0) {
            return redirect()->route('showHome');
        } else {
            return redirect()->route('showlogin');
        }
    }
}
