<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\ApiClient;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Messaging::class, function ($app) {
            // Get the Firebase credentials and project_id from the config
            $firebaseConfig = config('firebase');
            $projectId = $firebaseConfig['project_id']; // Ensure project_id is available

            // Create the Firebase Factory instance
            $factory = (new Factory)->withCredentials($firebaseConfig['credentials']['file']);

            // Initialize the Messaging client
            $messaging = $factory->createMessaging();

            // Set project_id explicitly if needed
            // Note: You can skip this line if the `createMessaging()` method already handles it internally
            $messaging->setProjectId($projectId);

            return $messaging;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
