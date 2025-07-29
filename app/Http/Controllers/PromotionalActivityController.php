<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionalActivity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PromotionalActivityController extends Controller
{

    // show episodes in table
    public function table()
    {
        $promotional = PromotionalActivity::latest()->get();
        return view('admin.promotionalactivities-table', compact('promotional'));
    }

}
