<?php

namespace App\Providers;

use App\Helpers\TCAPI;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Helpers\TCAPI', function($app)
        {
            return new TCAPI();
        });
    }
}
