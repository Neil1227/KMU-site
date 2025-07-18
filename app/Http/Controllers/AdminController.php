<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;

class AdminController extends Controller
{
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // Fetch episodes
        return view('admin.ictv', compact('episodes')); // Pass them to view
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
}