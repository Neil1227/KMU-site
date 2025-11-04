<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Research;
use App\Models\Notification;
use App\Models\RegisteredTechnology;
use App\Models\Extension;

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
        // ─── Notifications & Registered Tech Counts ─────────────
        View::composer('layouts.admin', function ($view) {
            $newApplicationsCount = Notification::where('is_read', false)->count();
            $newRegisteredCount   = RegisteredTechnology::where('is_new', true)->count();

            $view->with(compact('newApplicationsCount', 'newRegisteredCount'));
        });

        // ─── Total Page Views ─────────────
        $totalPageViews = DB::table('page_views')->sum('count');
        View::share('totalPageViews', $totalPageViews);

        // ─── Pending Extension Count ─────────────
        $pendingCount = Extension::where('status', 'active')->count();

        // ─── Pending Research Count (for New Research section) ─────────────
        $newResearchCount = Research::where('status', 'pending')->count();

        // ─── Share Globally ─────────────
        View::share([
            'pendingCount'     => $pendingCount,
            'newResearchCount' => $newResearchCount,
        ]);
    }
}
