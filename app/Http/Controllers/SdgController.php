<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdg;

class SdgController extends Controller
{
    public function index()
    {
        $sdgs = Sdg::orderBy('sdg_number')->get();

        // Make sure the view name is correct!
        return view('sdgs.sdgs', compact('sdgs'));
        // 'sdgs.sdgs' assumes the Blade is at resources/views/sdgs/sdgs.blade.php
    }
}
