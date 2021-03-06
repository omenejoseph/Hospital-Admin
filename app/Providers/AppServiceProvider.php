<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ward;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $wards = Ward::all();
       View::share('wards', $wards);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
