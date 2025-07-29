<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionalActivity;

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
    public function promotionalActivities()
    {
        $promotional = PromotionalActivity::latest()->get();
        return view('media-resources-section.promotional', compact('promotional'));
    }
}
