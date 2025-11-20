<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;
use App\Models\Newsletter;
use App\Models\Notification;
use App\Models\Podcast;
use App\Models\PromotionalActivity;
use App\Models\RecentActivity;
use App\Models\RegisteredTechnology;
use App\Models\Technology;
use App\Models\Demographic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Dashboard Counts
    public function dot()
    {
        $newApplicationsCount = Notification::where('is_read', false)->count();
        $newRegisteredCount = RegisteredTechnology::where('is_new', true)->count();

        return view('admin.dashboard', compact('newApplicationsCount', 'newRegisteredCount'));
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('user', $request->user)->first();

        if (! $admin) {
            return back()->withErrors(['user' => 'Username not found.'])->withInput();
        }

        if (! Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['password' => 'Incorrect password.'])->withInput();
        }

        Session::put([
            'admin_logged_in' => true,
            'admin_user' => $admin->user,
            'admin_id' => $admin->id,
            'admin_role' => $admin->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
    }

    // Logout
    public function logout()
    {
        Session::flush();

        return redirect()->route('admin.login');
    }

    // Recent Activities
    public function recentActivitiesTable()
    {
        $recentActivities = RecentActivity::latest()->get();

        return view('admin.recent-table', compact('recentActivities'));
    }

    public function deleteRecentActivity($id)
    {
        RecentActivity::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        $keepIds = RecentActivity::latest()->take(3)->pluck('id');
        RecentActivity::whereNotIn('id', $keepIds)->delete();

        return redirect()->back()->with('success', 'All recent activities except the latest 3 have been deleted.');
    }

    // Dashboard main page
    public function dashboard()
    {
        return view('admin.dashboard', $this->getAdminPageData());
    }

    // Individual admin pages (ICTV, IEC, Modules, etc.)
    public function ictv()
    {
        return view('admin.ictv', $this->getAdminPageData());
    }

    public function iec()
    {
        return view('admin.iec', $this->getAdminPageData());
    }

    public function modules()
    {
        return view('admin.modules', $this->getAdminPageData());
    }

    public function newsletter()
    {
        return view('admin.newsletter', $this->getAdminPageData());
    }

    public function promotional()
    {
        return view('admin.promotionalactivities', $this->getAdminPageData());
    }

    public function podcast()
    {
        return view('admin.podcast', $this->getAdminPageData());
    }

    public function technology()
    {
        return view('admin.technology', $this->getAdminPageData());
    }

    // Centralized method to get data for all admin pages
    private function getAdminPageData()
    {
        return [
            'episodes' => Ictv::latest()->get(),
            'iecMaterials' => IECMaterial::latest()->get(),
            'modules' => Module::latest()->get(),
            'newsletter' => Newsletter::latest()->get(),
            'promotional' => PromotionalActivity::latest()->get(),
            'podcast' => Podcast::latest()->get(),
            'technologies' => Technology::latest()->get(),
            'recentActivities' => RecentActivity::latest()->take(3)->get(),
            'totalVisitors' => Demographic::count(),
        ];
    }
}
