<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;


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
    $newsletters = [
        [
            'file' => 'newsletter/Innovation In Focus Quarter 4.pdf',
            'thumbnail' => 'NEWS_Innovation In Focus Q4.png',
            'title' => 'Innovation In Focus Quarter 4',
        ],
        [
            'file' => 'newsletter/Innovation In Focus Quarter 3.pdf',
            'thumbnail' => 'NEWS_Innovation In Focus Q3.png',
            'title' => 'Innovation In Focus Quarter 3',
        ],
        [
            'file' => 'newsletter/Innovation In Focus Quarter 2.pdf',
            'thumbnail' => 'NEWS_Issue 2 Quarter 2 Final.png',
            'title' => 'Innovation In Focus Quarter 2',
        ],
        [
            'file' => 'newsletter/Innovation In Focus Quarter 1.pdf',
            'thumbnail' => 'NEWS_Innovation In Focus Q1.png',
            'title' => 'Innovation In Focus Quarter 1',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 2, Quarter 4.pdf',
            'thumbnail' => 'NEWS_IPTBM_(V2,Q4).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 4',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 2, Quarter 3.pdf',
            'thumbnail' => 'NEWS_IP-TBM in Focus (V2,Q3).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 3',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 2, Quarter 2.pdf',
            'thumbnail' => 'NEWS_IP-TBM in Focus (V2,Q2).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 2',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 2, Quarter 1.pdf',
            'thumbnail' => 'NEWS_IP-TBM in Focus (V2,Q1) (1).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 1',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 1, Issue 3.pdf',
            'thumbnail' => 'NEWS_FINAL Q4.png',
            'title' => 'IPTBM In Focus, Volume 1, Issue 3',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 1, Issue 2.pdf',
            'thumbnail' => 'NEWS_IPTBM In Focus (Q3).png',
            'title' => 'IPTBM In Focus, Volume 1, Issue 2',
        ],
        [
            'file' => 'newsletter/IPTBM In Focus, Volume 1, Issue 1.pdf',
            'thumbnail' => 'NEWS_IPTBM In Focus, Volume 1, Issue 1.png',
            'title' => 'IPTBM In Focus, Volume 1, Issue 1',
        ],
        [
            'file' => 'iec_brochure/NEWS_FINAL_2025 In Focus Q1.pdf',
            'thumbnail' => 'NEWS_FINAL_2025 In Focus Q1.png',
            'title' => 'In progress',
        ],
    ];

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
