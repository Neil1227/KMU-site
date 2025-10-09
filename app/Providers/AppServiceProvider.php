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
        // Make the notification and registered tech counts available in the admin layout
        View::composer('layouts.admin', function ($view) {
            $newApplicationsCount = Notification::where('is_read', false)->count();
            $newRegisteredCount   = RegisteredTechnology::where('is_new', true)->count();

            $view->with(compact('newApplicationsCount', 'newRegisteredCount'));
        });

        // Share total page views globally to all views
        $totalPageViews = DB::table('page_views')->sum('count');
        View::share('totalPageViews', $totalPageViews);
    }
}
