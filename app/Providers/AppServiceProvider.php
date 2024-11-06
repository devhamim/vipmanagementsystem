<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use Illuminate\Support\Facades\Notification;
use Kreait\Firebase\Messaging;
use Illuminate\Contracts\Events\Dispatcher;
use Kreait\Firebase\Contract\Messaging as FirebaseMessaging;


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
    public function boot(Dispatcher $events): void
    {

        Paginator::useBootstrap();

        Notification::extend('fcm', function ($app) use ($events) {
            // Get the instance of FirebaseMessaging
            $firebaseMessaging = $app->make(FirebaseMessaging::class);

            // Create a new FcmChannel with the correct parameters
            return new FcmChannel($events, $firebaseMessaging);
        });

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
