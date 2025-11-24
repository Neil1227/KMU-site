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
        return view('sdg', compact('sdgs'));

        // 'sdgs.sdgs' assumes the Blade is at resources/views/sdgs/sdgs.blade.php
    }
 public function show($sdg)
    {
        $sdgData = Sdg::where('sdg_number', $sdg)->firstOrFail();

        $galleryImages = [
            asset("assets/img/media_thumbnail/ICTv.png"),
            asset("assets/img/media_thumbnail/ICTv.png"),
            asset("assets/img/media_thumbnail/ICTv.png"),
            asset("assets/img/media_thumbnail/ICTv.png"),
            asset("assets/img/media_thumbnail/ICTv.png"),
            asset("assets/img/media_thumbnail/ICTv.png"),
        ];

        return view('sdg-gallery', compact('sdgData', 'galleryImages'));
    }
}
