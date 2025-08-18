<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechnologyProductController extends Controller
{
    public function index()
    {
        return view('technology-product'); 
        // make sure you create resources/views/technology-product.blade.php
    }
}
