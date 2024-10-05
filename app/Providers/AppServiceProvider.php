<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // frontend app
        View::composer('main.layout.app', function ($view){
            $view->with('setting', Setting::first());
        });
        // frontend sitebar
        View::composer('main.layout.sitebar', function ($view){
            $view->with('setting', Setting::first());
        });
        // frontend footer
        View::composer('main.layout.footer', function ($view){
            $view->with('setting', Setting::first());
        });
        // frontend auth
        View::composer('auth.login', function ($view){
            $view->with('setting', Setting::first());
        });
    }
}
