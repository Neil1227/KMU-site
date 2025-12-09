<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\PromotionalActivity; // Add this line
use Illuminate\Support\Facades\DB;
use App\Models\Registration;

class MainController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function plagscan()
    {
        return view('plagscan');
    }

    public function about()
    {
        return view('about');
    }
    public function iptbm()
    {
        return view('iptbm');
    }
    public function tbi()
    {
        return view('tbi');
    }
    public function promotionalActivities()
    {
        $promotional = PromotionalActivity::latest()->get();

        return view('media-resources-section.promotional', compact('promotional'));
    }

    public function podcast()
    {
        $podcasts = Podcast::latest()->get();

        return view('media-resources-section.podcast', compact('podcasts'));
    }

    public function index()
    {
        $totalPageViews = DB::table('page_views')->where('id', 1)->value('count');
        $ipAppliedCount = Registration::count(); // Count all registered IP entries

        return view('homepage', compact('totalPageViews', 'ipAppliedCount'));
    }
    public function ipRegistered()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->paginate(10);

        // Count categories
        $totalCount = Registration::count();
        $patentCount = Registration::where('ip_type', 'Patent')->count();
        $utilityModelCount = Registration::where('ip_type', 'UM')->count();

        // For any type that is not copyright or utility model
        $othersCount = Registration::whereNotIn('ip_type', [
            'Patent',
            'UM'
        ])->count();

        return view('ipregistered', compact(
            'registrations',
            'totalCount',
            'patentCount',
            'utilityModelCount',
            'othersCount'
        ));
    }
}
