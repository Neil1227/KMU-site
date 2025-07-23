<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial; 
use App\Models\Module; 
use App\Models\Newsletter; 

class AdminController extends Controller
{
    // dashboard only
    public function dashboard()
    {
        $episodes = Ictv::latest()->get();
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        return view('admin.dashboard', compact('episodes', 'iecMaterials', 'modules', 'newsletter'));
    }

    // ictv only
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // Fetch episodes
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        return view('admin.ictv', compact('episodes', 'iecMaterials', 'modules','newsletter')); // Pass them to view
    }

    //iec only
    public function iec() {
        $episodes = Ictv::all();
        $iecMaterials = IECMaterial::latest()->get(); // Make sure this is set
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();
        return view('admin.iec', compact('episodes', 'iecMaterials', 'modules','newsletter'));
    }
// ----------note: for accessing different page, it needs to declare the eloquet 

    //modules only
    public function modules() {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();

        return view('admin.modules', compact('iecMaterials', 'episodes', 'modules','newsletter'));
    }

    public function newsletter() {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        $newsletter = Newsletter::latest()->get();

        return view('admin.newsletter', compact('iecMaterials', 'episodes','modules', 'newsletter'));
    }

    public function promotional() {
        return view('admin.promotional');
    }
}