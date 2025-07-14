<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function ictv() {
        return view('admin.ictv');
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