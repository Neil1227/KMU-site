<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial; 
use App\Models\Module; 


class AdminController extends Controller
{
    // dashboard only
    public function dashboard()
    {
        $episodes = Ictv::latest()->get();
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        $modules = Module::latest()->get();
        return view('admin.dashboard', compact('episodes', 'iecMaterials', 'modules'));
    }

    // ictv only
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // Fetch episodes
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        $modules = Module::latest()->get();
        return view('admin.ictv', compact('episodes', 'iecMaterials', 'modules')); // Pass them to view
    }

    //iec only
    public function iec() {
        $episodes = Ictv::all();
        $iecMaterials = IECMaterial::latest()->get(); // Make sure this is set
        $modules = Module::latest()->get();
        return view('admin.iec', compact('episodes', 'iecMaterials', 'modules'));
    }
// ----------note: for accessing different page, it needs to declare the eloquet 

    //modules only
    public function modules()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();

        return view('admin.modules', compact('iecMaterials', 'episodes', 'modules'));
    }

    public function newsletter() {
        return view('admin.newsletter');
    }
    public function promotional() {
        return view('admin.promotional');
    }
}