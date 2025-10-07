<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Ictv;
use App\Models\IECMaterial; 
use App\Models\Module; 
use App\Models\Newsletter; 
use App\Models\PromotionalActivity;
use App\Models\RecentActivity;
use App\Models\Podcast;
use App\Models\Technology;
use App\Models\Notification;
use App\Models\RegisteredTechnology;
use Illuminate\Support\Facades\DB;


use App\Models\Admin;

class AdminController extends Controller
{
    public function dot()
{
    $newApplicationsCount = Notification::where('is_read', false)->count();
    $newRegisteredCount = RegisteredTechnology::where('is_new', true)->count();

    return view('admin.dashboard', compact('newApplicationsCount', 'newRegisteredCount'));
}
    //Logins
    public function login(Request $request)
    {
        // 1. Validate request
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Attempt to find user
        $admin = Admin::where('user', $request->user)->first();

        // 3. Check if user exists and password matches
        if ($admin && Hash::check($request->password, $admin->password)) {
            // 4. Store login info in session
            Session::put('admin_logged_in', true);
            Session::put('admin_user', $admin->user);

            return redirect()->route('admin.dashboard'); // Adjust this route
        }

        // 5. If login fails
        return back()->withErrors(['user' => 'Invalid credentials.']);
    }
    
    public function logout()
    {
        Session::flush(); // Clears all session data
        return redirect()->route('admin.login');
    }

    //For  recent activities
    public function index()
    {
        $recentActivities = RecentActivity::latest()->take(5)->get(); // or ->limit(10)
        return view('admin.dashboard', compact('recentActivities'));
    }

    public function recentActivitiesTable()
    {
        $recentActivities = RecentActivity::latest()->get();

        return view('admin.recent-table', compact('recentActivities'));
    }

    public function deleteRecentActivity($id)
    {
        $activity = RecentActivity::findOrFail($id);
        $activity->delete();

        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        // Get IDs of the latest 3 records
        $keepIds = RecentActivity::orderBy('created_at', 'desc')
            ->take(3)
            ->pluck('id');

        // Delete all except those IDs
        RecentActivity::whereNotIn('id', $keepIds)->delete();

        return redirect()->back()->with('success', 'All recent activities except the latest 3 have been deleted.');
    }


// ----------note: for accessing different page, it needs to declare the eloquet 
    // dashboard only
    public function dashboard()
    {
        $episodes = Ictv::latest()->get();
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get(); // ✅ Added technologies
        $recentActivities = RecentActivity::latest()->take(3)->get();
        $totalPageViews = DB::table('page_views')->sum('count');


        return view('admin.dashboard', compact(
            'episodes',
            'iecMaterials',
            'modules',
            'newsletter',
            'promotional',
            'podcast',
            'technologies', // ✅ Pass technologies to view
            'recentActivities',
            'totalPageViews'
        ));
    }


    // ictv only
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // Fetch episodes
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        return view('admin.ictv', compact('episodes', 'iecMaterials', 'modules','newsletter','promotional','podcast','technologies',)); // Pass them to view
    }

    //iec only
    public function iec() {
        $episodes = Ictv::all();
        $iecMaterials = IECMaterial::latest()->get(); // Make sure this is set
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        return view('admin.iec', compact('episodes', 'iecMaterials', 'modules','newsletter','promotional','podcast','technologies',));
    }

    //modules only
    public function modules() {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        return view('admin.modules', compact('iecMaterials', 'episodes', 'modules','newsletter','promotional','podcast','technologies',));
    }

    //Newsletter only
    public function newsletter() {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        return view('admin.newsletter', compact('iecMaterials', 'episodes','modules', 'newsletter','promotional','podcast','technologies',));
    }

    //Promotional activities only
    public function promotional() {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        return view('admin.promotionalactivities', compact('iecMaterials', 'episodes','modules', 'newsletter','promotional','podcast','technologies',));
    }

    //Podcast Only
    public function podcast() {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        return view('admin.podcast', compact('iecMaterials', 'episodes','modules', 'newsletter','promotional','podcast','technologies',));
    }

    // Technology Only
    public function technology()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        $promotional = PromotionalActivity::latest()->get();
        $podcast = Podcast::latest()->get();
        $technologies = Technology::latest()->get();
        $technologies = Technology::latest()->get();

        return view('admin.technology', compact(
            'iecMaterials',
            'episodes',
            'modules',
            'newsletter',
            'promotional',
            'podcast',
            'technologies'
        ));
    }

}