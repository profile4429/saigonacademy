<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\feedback;
use App\Models\news;
use App\Models\programs;
use App\Models\intro;
use App\Models\contact;
use App\Models\admissions;
use App\Models\introlocale;
use App\Models\programslocale;
use App\Models\admissionslocale;
use App\Models\newslocale;
use App\Models\contactlocale;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class homecontroller extends Controller
{
    public function showHomepage()
    {
        $lang = Config::get('app.locale');

        $feedback = feedback::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $programs = programs::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $news = news::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $admissions = admissions::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        
        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        return view('frontend.home')->with([
            'feedback' => $feedback,
            'programs' => $programs,
            'news' => $news,
            'intro' => $intro,
            'contact' => $contact,
            'admissions' => $admissions,
        ]);
    }
    // About la showintro a` yes
    public function showIntro(Request $request)
    {
        $id = $request->id;
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $result = introlocale::where('vi', $request->id)->orWhere('en', $request->id)->first();

        $getintro_id = intro::whereIn('id', [$result->vi, $result->en])->whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
   
        return view('frontend.intro')->with([
            'contact' => $contact,
            'getintro_id'=>$getintro_id,
            'intro' => $intro,
        ]);
    }
    public function showPrograms()
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $programs = programs::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        return view('frontend.programs')->with([
            'programs' => $programs,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }
    public function programs_detail(Request $request)
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        $result = programslocale::where('vi', $request->id)->orWhere('en', $request->id)->first();

        $getprograms_id = programs::whereIn('id', [$result->vi, $result->en])->whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        return view('frontend.programs_detail')->with([
            'getprograms_id' => $getprograms_id,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }

    public function showAdmissions()
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $admissions = admissions::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })
        ->orderBy('date', 'desc')
        ->get();

 

        return view('frontend.admissions')->with([
            'admissions' => $admissions,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }

    public function admissions_detail(Request $request)
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $result = admissionslocale::where('vi', $request->id)->orWhere('en', $request->id)->first();

        $getadmissions_id = admissions::whereIn('id', [$result->vi, $result->en])->whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        return view('frontend.admissions_detail')->with([
            'getadmissions_id' => $getadmissions_id,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }

    public function showNews()
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        $news = news::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
 

        return view('frontend.news')->with([
            'news' => $news,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }

    public function news_detail(Request $request)
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();
        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $result = newslocale::where('vi', $request->id)->orWhere('en', $request->id)->first();

        $getnews_id = news::whereIn('id', [$result->vi, $result->en])->whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        return view('frontend.news_detail')->with([
            'getnews_id' => $getnews_id,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }

    public function showContact()
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        return view('frontend.contact')->with([

            'contact' => $contact,
            'intro' => $intro,
        ]);
    }

    public function contact_detail(Request $request)
    {
        $lang = Config::get('app.locale');

        $contact = contact::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();

        $intro = intro::whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        $result = contactlocale::where('vi', $request->id)->orWhere('en', $request->id)->first();

        $getcontact_id = contact::whereIn('id', [$result->vi, $result->en])->whereHas('language', function ($query) use ($lang) {
            return $query->where('title', $lang);
        })->get();


        return view('frontend.contact_detail')->with([
            'getcontact_id' => $getcontact_id,
            'contact' => $contact,
            'intro' => $intro,
        ]);
    }
}
