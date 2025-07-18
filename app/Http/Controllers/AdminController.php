<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;

class AdminController extends Controller
{
    // ictv only
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // Fetch episodes
        return view('admin.ictv', compact('episodes')); // Pass them to view
    }
    public function dashboard()
    {
        $episodes = Ictv::latest()->get(); // or limit if needed
        return view('admin.dashboard', compact('episodes'));
    }

    public function iec() {
        return view('admin.iec');
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