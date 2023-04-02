<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\homecontroller;
use App\Http\Controllers\backend\introController;
use App\Http\Controllers\backend\programsController;
use App\Http\Controllers\backend\languageController;
use App\Http\Controllers\backend\admissionsController;
use App\Http\Controllers\backend\newsController;
use App\Http\Controllers\backend\contactController;
use App\Http\Controllers\backend\feedbackController;
use App\Http\Controllers\backend\pictureController;
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

Route::get('/admin/login',[homecontroller::class, 'showlogin'] )->name('showlogin');
Route::post('/admin/checklogin',[homecontroller::class, 'checklogin'] )->name('checklogin');

Route::get('/admin/register',[homecontroller::class, 'showregister'] )->name('showregister');
Route::get('/admin/home',[homecontroller::class, 'showHome'] )->name('showHome');
Route::get('/admin/dashboard',[homecontroller::class, 'dashboard'] )->name('dashboard');


Route::get('/admin/intro',[introController::class,'intro'])->name('intro');
Route::post('/admin/addIntro',[introController::class,'addIntro'])->name('addIntro');
Route::post('/admin/deleteIntro',[introController::class,'deleteIntro'])->name('deleteIntro');
Route::get('/admin/showdataIntro',[introController::class,'showdataIntro'])->name('showdataIntro');
Route::post('/admin/editIntro',[introController::class,'editIntro'])->name('editIntro');
Route::get('/admin/showtransIntro',[introController::class,'showtransIntro'])->name('showtransIntro');
Route::post('/admin/transIntro',[introController::class,'transIntro'])->name('transIntro');



Route::get('/admin/programs',[programsController::class,'programs'])->name('programs');
Route::post('/admin/addPrograms',[programsController::class,'addPrograms'])->name('addPrograms');
Route::post('/admin/deletePrograms',[programsController::class,'deletePrograms'])->name('deletePrograms');
Route::get('/admin/showdataPrograms',[programsController::class,'showdataPrograms'])->name('showdataPrograms');
Route::post('/admin/editPrograms',[programsController::class,'editPrograms'])->name('editPrograms');
Route::get('/admin/showtransPrograms',[programsController::class,'showtransPrograms'])->name('showtransPrograms');
Route::post('/admin/transPrograms',[programsController::class,'transPrograms'])->name('transPrograms');


Route::get('/admin/admissions',[admissionsController::class,'admissions'])->name('admissions');
Route::post('/admin/addAdmissions',[admissionsController::class,'addAdmissions'])->name('addAdmissions');
Route::post('/admin/deleteAdmissions',[admissionsController::class,'deleteAdmissions'])->name('deleteAdmissions');
Route::get('/admin/showdataAdmissions',[admissionsController::class,'showdataAdmissions'])->name('showdataAdmissions');
Route::post('/admin/editAdmissions',[admissionsController::class,'editAdmissions'])->name('editAdmissions');
Route::get('/admin/showtransAdmissions',[admissionsController::class,'showtransAdmissions'])->name('showtransAdmissions');
Route::post('/admin/transAdmissions',[admissionsController::class,'transAdmissions'])->name('transAdmissions');

Route::get('/admin/news',[newsController::class,'news'])->name('news');
Route::post('/admin/addNews',[newsController::class,'addNews'])->name('addNews');
Route::post('/admin/deleteNews',[newsController::class,'deleteNews'])->name('deleteNews');
Route::get('/admin/showdataNews',[newsController::class,'showdataNews'])->name('showdataNews');
Route::post('/admin/editNews',[newsController::class,'editNews'])->name('editNews');
Route::get('/admin/showtransNews',[newsController::class,'showtransNews'])->name('showtransNews');
Route::post('/admin/transNews',[newsController::class,'transNews'])->name('transNews');

Route::get('/admin/contact',[contactController::class,'contact'])->name('contact');
Route::post('/admin/addContact',[contactController::class,'addContact'])->name('addContact');
Route::post('/admin/deleteContact',[contactController::class,'deleteContact'])->name('deleteContact');
Route::get('/admin/showdataContact',[contactController::class,'showdataContact'])->name('showdataContact');
Route::post('/admin/editContact',[contactController::class,'editContact'])->name('editContact');
Route::get('/admin/showtransContact',[contactController::class,'showtransContact'])->name('showtransContact');
Route::post('/admin/transContact',[contactController::class,'transContact'])->name('transContact');

Route::get('/admin/feedback',[feedbackController::class,'feedback'])->name('feedback');
Route::post('/admin/addFeedback',[feedbackController::class,'addFeedback'])->name('addFeedback');
Route::post('/admin/deleteFeedback',[feedbackController::class,'deleteFeedback'])->name('deleteFeedback');
Route::get('/admin/showdataFeedback',[feedbackController::class,'showdataFeedback'])->name('showdataFeedback');
Route::post('/admin/editFeedback',[feedbackController::class,'editFeedback'])->name('editFeedback');
Route::get('/admin/showtransFeedback',[feedbackController::class,'showtransFeedback'])->name('showtransFeedback');
Route::post('/admin/transFeedback',[feedbackController::class,'transFeedback'])->name('transFeedback');

Route::get('/admin/picture',[pictureController::class,'picture'])->name('picture');
Route::post('/admin/addPicture',[pictureController::class,'addPicture'])->name('addPicture');
Route::post('/admin/addPictureMembers',[pictureController::class,'addPictureMembers'])->name('addPictureMembers');
Route::post('/admin/deletePicture',[pictureController::class,'deletePicture'])->name('deletePicture');



Route::get('/admin/language',[languageController::class,'language'])->name('language');
Route::post('/admin/addlanguage',[languageController::class,'addlanguage'])->name('addlanguage');
Route::post('/admin/deleteLanguage',[languageController::class,'deleteLanguage'])->name('deleteLanguage');






