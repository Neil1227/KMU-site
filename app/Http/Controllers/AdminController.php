<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial; 

class AdminController extends Controller
{
    // ictv only
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // Fetch episodes
        $iecMaterials = IECMaterial::all(); // or paginate if needed
        return view('admin.ictv', compact('episodes', 'iecMaterials')); // Pass them to view
    }


    public function dashboard()
    {
        $episodes = Ictv::latest()->get();
        $iecMaterials = IECMaterial::all(); // or paginate if needed

        return view('admin.dashboard', compact('episodes', 'iecMaterials'));
    }

    //iec only
    public function iec() {
        $episodes = Ictv::all();
        $iecMaterials = IECMaterial::latest()->get(); // Make sure this is set
        return view('admin.iec', compact('episodes', 'iecMaterials'));
    }


    public function modules() {
        return view('admin.modules');
    }
    public function newsletter() {
        return view('admin.newsletter');
    }
    public function promotional() {
        return view('admin.promotional');
    }
}