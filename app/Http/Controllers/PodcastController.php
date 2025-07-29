<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;

class PodcastController extends Controller
{
    public function table()
    {
        $podcasts = Podcast::latest()->get();
        return view('admin.podcast-table', compact('podcasts'));
    }

}
