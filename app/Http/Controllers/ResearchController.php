<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchController extends Controller
{
    public function agriculture() {
        return view('research-section.agriculture');
    }
    public function aquaculture() {
        return view('research-section.aquaculture');
    }
    public function livestock() {
        return view('research-section.livestock');
    }
    public function livelihood() {
        return view('research-section.livelihood');
    }
    public function biotechnology() {
        return view('research-section.biotechnology');
    }
    public function rootCrops() {
        return view('research-section.root-crops');
    }
    public function iot() {
        return view('research-section.iot');
    }
    public function others() {
        return view('research-section.others');
    }

}