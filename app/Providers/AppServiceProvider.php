<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SlackNotificationServiceInterface;
use App\Services\SlackNotificationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            SlackNotificationServiceInterface::class,
            SlackNotificationService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
