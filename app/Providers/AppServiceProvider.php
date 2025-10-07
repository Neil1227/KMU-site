<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use App\Models\RegisteredTechnology;

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
    // Make the variables available to the sidebar view
    View::composer('layouts.admin', function ($view) {
        $newApplicationsCount = Notification::where('is_read', false)->count();
        $newRegisteredCount   = RegisteredTechnology::where('is_new', true)->count();

        $view->with(compact('newApplicationsCount', 'newRegisteredCount'));
    });
}
}