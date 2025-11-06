<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Research;
use App\Models\Notification;
use App\Models\Kmu_Thesis;
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
        View::composer('layouts.admin', function ($view) {
            $newResearchCount     = Research::where('status', 'pending')->count();
            $newApplicationsCount = Notification::where('is_read', false)->count();
            $newRegisteredCount   = RegisteredTechnology::where('is_new', true)->count();

            // Extension & Research statuses
            $pendingExtension     = Extension::where('status', 'active')->count(); // 🔥 Badge for Extension
            $pendingKmuResearch   = Kmu_Thesis::where('status', 'pending')->count();
            $pendingResearchOnly  = Research::where('status', 'pending')->count();

            $view->with(compact(
                'newResearchCount',
                'newApplicationsCount',
                'newRegisteredCount',
                'pendingExtension', // 👈 important
                'pendingKmuResearch',
                'pendingResearchOnly'
            ));
        });

        // ─── Total Page Views ─────────────
        $totalPageViews = DB::table('page_views')->sum('count');
        View::share('totalPageViews', $totalPageViews);
    }
}
