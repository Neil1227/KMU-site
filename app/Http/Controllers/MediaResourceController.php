<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;
use App\Models\Newsletter;

class MediaResourceController extends Controller
{
    public function ictv()
    {
        $episodes = Ictv::latest()->get(); // fetch all ICTV entries ordered by latest first
        return view('media-resources-section.ictv', compact('episodes'));
    }

    public function iec()
    {
        $brochures = IECMaterial::latest()->get(); // Fetch IEC records from DB
        return view('media-resources-section.iec', compact('brochures'));
    }

    public function modules()
    {
        $modules = Module::latest()->get();
        return view('media-resources-section.modules', compact('modules'));
    }

    public function newsletter()
    {
        $newsletters = Newsletter::latest()->get();
        return view('media-resources-section.newsletter', compact('newsletters'));
    }
 



public function techPortfolio()
{
    $techImages = [
        'COVER.jpg',
        'TECH1.jpg',
        'TECH3.jpg',
        'TECH4.jpg',
        'TECH5.jpg',
        'TECH7.jpg',
        'TECH8.jpg',
        'TECH9.jpg',
        'TECH10.jpg',
        'TECH11.jpg',
        'PSAU Tech. Portfolio (1)_page-0013.jpg',
    ];

    return view('media-resources-section.tech-portfolio', compact('techImages'));
}

}
