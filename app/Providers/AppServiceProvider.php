<?php

namespace App\Providers;

use App\Models\Commodity;
use App\Models\Extension;
use App\Models\Kmu_Thesis;
use App\Models\Notification;
use App\Models\RegisteredTechnology;
use App\Models\Research;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('admin.*', function ($view) {
            $newResearchCount = Research::where('status', 'pending')->count();
            $newApplicationsCount = Notification::where('is_read', false)->count();
            $newRegisteredCount = RegisteredTechnology::where('is_new', true)->count();
            $newCount = Commodity::where('created_at', '>=', Carbon::now()->subDay())->count();
            // Extension & Research statuses
            $pendingExtension = Extension::where('status', 'active')->count(); // 🔥 Badge for Extension
            $pendingKmuResearch = Kmu_Thesis::where('status', 'pending')->count();
            $pendingResearchOnly = Research::where('status', 'pending')->count();

            $view->with(compact(
                'newResearchCount',
                'newApplicationsCount',
                'newRegisteredCount',
                'pendingExtension', // 👈 important
                'pendingKmuResearch',
                'pendingResearchOnly',
                'newCount'
            ));
        });

        // ─── Total Page Views ─────────────
        $totalPageViews = DB::table('page_views')->sum('count');
        View::share('totalPageViews', $totalPageViews);
    }
}
