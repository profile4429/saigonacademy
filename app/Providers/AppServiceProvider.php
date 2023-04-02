<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\language;
use App\Models\intro;
use App\Models\programs;
use App\Models\admissions;
use App\Models\news;
use App\Models\contact;
use App\Models\feedback;
use App\Models\picture;







class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $language= language::all();
        view()->share('language', $language);
        $intro= intro::all();
        view()->share('intro', $intro);
        $programs= programs::all();
        view()->share('programs', $programs);
        $admissions= admissions::all();
        view()->share('admissions', $admissions);
        $news= news::all();
        view()->share('news', $news);
        $contact= contact::all();
        view()->share('contact', $contact);
        $feedback= feedback::all();
        view()->share('feedback', $feedback);
        $picture= picture::all();
        view()->share('picture', $picture);
        
    }
}
