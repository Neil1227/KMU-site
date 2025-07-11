<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact'); // Make sure you have resources/views/contact.blade.php
    }
}
