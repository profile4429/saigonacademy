<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\homecontroller;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('locale/{locale}',function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
   });
Route::get('/home',[homecontroller::class, 'showHomepage'] )->name('showHomepage');

Route::get('/home/intro',[homecontroller::class, 'showIntro'] )->name('showIntro');

Route::get('/home/programs',[homecontroller::class, 'showPrograms'] )->name('showPrograms');
Route::get('/home/programs_detail',[homecontroller::class, 'programs_detail'] )->name('programs_detail');

Route::get('/home/admissions',[homecontroller::class, 'showAdmissions'] )->name('showAdmissions');
Route::get('/home/admissions_detail',[homecontroller::class, 'admissions_detail'] )->name('admissions_detail');


Route::get('/home/news',[homecontroller::class, 'showNews'] )->name('showNews');
Route::get('/home/news_detail',[homecontroller::class, 'news_detail'] )->name('news_detail');


Route::get('/home/contact',[homecontroller::class, 'showContact'] )->name('showContact');
Route::get('/home/contact_detail',[homecontroller::class, 'contact_detail'] )->name('contact_detail');






