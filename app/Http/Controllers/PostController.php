<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;

class PostController extends Controller
{
public function index()
{
    // Get posts with media and uploader info
$posts = Post::with('media', 'admin')
    ->orderBy('created_at', 'desc')
    ->get();


    // Prepare Facebook Pages (static)
    $facebookPages = [
        [
            'title' => 'PSAU Office of Extension and Training',
            'url' => 'https://www.facebook.com/PSAUOET',
            'logo' => 'assets/img/about/Logo (1).png',
        ],
        [
            'title' => 'PSAU Knowledge Management Center',
            'url' => 'https://www.facebook.com/psau.kmc',
            'logo' => 'assets/img/logo.png',
        ],
        [
            'title' => 'PSAU-Intellectual Property and Technology Business Management Office',
            'url' => 'https://www.facebook.com/psau.iptbm',
            'logo' => 'assets/img/iptbm.png',
        ],
        [
            'title' => 'PSAU-Technology Business Incubator',
            'url' => 'https://www.facebook.com/psau.tbi',
            'logo' => 'assets/img/sibultbi-logo.png',
        ],
    ];

    return view('media-resources-section.updates', compact('posts', 'facebookPages'));
}

}
