<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function promotional()
    {
        $episodes = [
            [
                'title' => 'Promotional Episode 1',
                'description' => 'Introduction to Sustainable Farming',
                'link' => 'https://www.facebook.com/ictrdpsau/videos/1111111111',
                'webp' => 'promo ep 1.webp',
                'png' => 'promo ep 1.png',
            ],
            [
                'title' => 'Promotional Episode 2',
                'description' => 'Empowering Local Farmers',
                'link' => 'https://www.facebook.com/ictrdpsau/videos/2222222222',
                'webp' => 'promo ep 2.webp',
                'png' => 'promo ep 2.png',
            ],
            // Add more episodes as needed
        ];

        return view('promotional', compact('episodes'));
    }
}
