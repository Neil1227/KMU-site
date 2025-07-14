<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaResourceController extends Controller
{
public function ictv()
{
    $episodes = [
        [
            'title' => 'ICTV EPISODE 11',
            'description' => 'Rice Production',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/1225786205694099',
            'webp' => 'ictv ep 11.webp',
            'png' => 'ictv ep 11.png',
        ],
        [
            'title' => 'ICTV EPISODE 10',
            'description' => 'Weed Management',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/1097242865536134',
            'webp' => 'ictv ep 10.webp',
            'png' => 'ictv ep 10.png',
        ],
        [
            'title' => 'ICTV EPISODE 9',
            'description' => 'Food Supplements for Tilapia',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/1120858289451940',
            'webp' => 'ictv ep 9.webp',
            'png' => 'ictv ep 9.png',
        ],
        [
            'title' => 'ICTV EPISODE 8',
            'description' => 'Sisid sa Aquaculture',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/545326328065713',
            'webp' => 'ictv ep 8.webp',
            'png' => 'ictv ep 8.png',
        ],
        [
            'title' => 'ICTV EPISODE 7',
            'description' => 'Kamalayan sa Palayan.',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/2513347652160787',
            'webp' => 'ictv ep 7.webp',
            'png' => 'ictv ep 7.png',
        ],
        [
            'title' => 'ICTV EPISODE 6',
            'description' => 'Cultivating abundance through fertilizer application.',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/6486186524792074',
            'webp' => 'ictv ep 6.webp',
            'png' => 'ictv ep 6.png',
        ],
        [
            'title' => 'ICTV EPISODE 5',
            'description' => 'Elevate your harvest with premium fertilizer.',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/1869446936782287',
            'webp' => 'ictv ep 5.webp',
            'png' => 'ictv ep 5.png',
        ],
        [
            'title' => 'ICTV EPISODE 4',
            'description' => 'Embracing a nourishing path to wellness.',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/658010909530119',
            'webp' => 'ictv ep 4.webp',
            'png' => 'ictv ep 4.png',
        ],
        [
            'title' => 'ICTV EPISODE 3',
            'description' => 'Waste Management',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/227609776097679',
            'webp' => 'ictv ep 3.webp',
            'png' => 'ictv ep 3.png',
        ],
        [
            'title' => 'ICTV EPISODE 2',
            'description' => 'Embracing a nourishing path to wellness.',
            'link' => 'https://www.facebook.com/ictrdpsau/videos/1134817413708942',
            'webp' => 'ictv ep 2.webp',
            'png' => 'ictv ep 2.png',
        ],
        [
            'title' => 'ICTV EPISODE 1',
            'description' => 'AGLIBUT SWEET TAMARIND',
            'link' => 'https://www.facebook.com/watch/?v=385537333118296',
            'webp' => 'ictv ep 1.webp',
            'png' => 'ictv ep 1.png',
        ],
    ];

    return view('media-resources-section.ictv', compact('episodes'));
}

public function iec()
{
    $brochures = [
        [
            'title' => 'Tilapia Supplement',
            'description' => 'Supplements aid tilapia farming by promoting growth, enhancing immunity, and improving feed efficiency.',
            'pdf' => 'Brochure-Tilapia_supplement.pdf',
            'image' => 'iec_tilapia_supplements.png',
        ],
        [
            'title' => 'Knowledge Management Unit',
            'description' => 'Where minds sit on the couch, ideas stir in a cup, and knowledge holds the mix.',
            'pdf' => 'KM-BROCHURE-FINAL.pdf',
            'image' => 'iec_km_brochure.png',
        ],
        [
            'title' => 'Challenges in Rice Production',
            'description' => 'A quick look into the key issues faced by rice farmers today.',
            'pdf' => 'CIRP_4.pdf',
            'image' => 'iec_CIRP.png',
        ],
        [
            'title' => 'WEED MANAGEMENT STRATEGIES IN MODERN Crop Science',
            'description' => 'An overview of effective weed control techniques for sustainable crop production.',
            'pdf' => 'WMSIMCS-Brochure.pdf',
            'image' => 'iec_wmsimcs.png',
        ],
    ];

    return view('media-resources-section.iec', compact('brochures'));
}

public function modules()
{
    $modules = [
        [
            'title' => 'Sibul TBI Module on Banana Chips Processing',
            'file' => 'Sibul TBI Module on Banana Chips Processing.pdf',
            'thumbnail' => 'Sibul TBI Module on Banana Chips Processing.png',
        ],
        [
            'title' => 'Sibul TBI Module on Business Model Canvas and Business Plan Preparation',
            'file' => 'Sibul TBI Module on Business Model Canvas and Business Plan Preparation.pdf',
            'thumbnail' => 'Sibul TBI Module on Business Model Canvas and Business Plan Preparation.png',
        ],
        [
            'title' => 'Sibul TBI Module on Catfish Farming in Traditional and Biofloc Technology',
            'file' => 'Sibul TBI Module on Catfish Farming in Traditional and Biofloc Technology.pdf',
            'thumbnail' => 'Sibul TBI Module on Catfish Farming in Traditional and Biofloc Technology.png',
        ],
        [
            'title' => 'Sibul TBI Module on Design Thinking',
            'file' => 'Sibul TBI Module on Design Thinking.pdf',
            'thumbnail' => 'Sibul TBI Module on Design Thinking.png',
        ],
        [
            'title' => 'Sibul TBI Module on Entrepreneurial Mindset',
            'file' => 'Sibul TBI Module on Entrepreneurial Mindset.pdf',
            'thumbnail' => 'Sibul TBI Module on Entrepreneurial Mindset.png',
        ],
        [
            'title' => 'Sibul TBI Module on Goat Farming Practices in the Philippines',
            'file' => 'Sibul TBI Module on Goat Farming Practices in the Philippines.pdf',
            'thumbnail' => 'Sibul TBI Module on Goat Farming Practices in the Philippines.png',
        ],
        [
            'title' => 'Sibul TBI Module on Hydroponics Farming',
            'file' => 'Sibul TBI Module on Hydroponics Farming.pdf',
            'thumbnail' => 'Sibul TBI Module on Hydroponics Farming.png',
        ],
        [
            'title' => 'Sibul TBI Module on Intellectual Property Rights',
            'file' => 'Sibul TBI Module on Intellectual Property Rights.pdf',
            'thumbnail' => 'Sibul TBI Module on Intellectual Property Rights.png',
        ],
        [
            'title' => 'Sibul TBI Module on Introduction to Digital Marketing',
            'file' => 'Sibul TBI Module on Introduction to Digital Marketing.pdf',
            'thumbnail' => 'Sibul TBI Module on Introduction to Digital Marketing.png',
        ],
        [
            'title' => 'Sibul TBI Module on Investment Readiness Level',
            'file' => 'Sibul TBI Module on IRL.pdf',
            'thumbnail' => 'Sibul TBI Module on IRL.png',
        ],
        [
            'title' => 'Sibul TBI Module on Legal Matters for Start Ups',
            'file' => 'Sibul TBI Module on Legal Matters for Start Ups.pdf',
            'thumbnail' => 'Sibul TBI Module on Legal Matters for Start Ups.png',
        ],
        [
            'title' => 'Sibul TBI Module on Obligations and Contracts',
            'file' => 'Sibul TBI Module on Obligations and Contracts.pdf',
            'thumbnail' => 'Sibul TBI Module on Obligations and Contracts.png',
        ],
        [
            'title' => 'Sibul TBI Module on Onion processing and other Onion Products',
            'file' => 'Sibul TBI Module on Onion processing and other Onion Products.pdf',
            'thumbnail' => 'Sibul TBI Module on Onion processing and other Onion Products.png',
        ],
        [
            'title' => 'Sibul TBI Module on Product Development',
            'file' => 'Sibul TBI Module on Product Development.pdf',
            'thumbnail' => 'Sibul TBI Module on Product Development.png',
        ],
        [
            'title' => 'Sibul TBI Module on Technology Readiness Level',
            'file' => 'Sibul TBI Module on TRL.pdf',
            'thumbnail' => 'Sibul TBI Module on TRL.png',
        ],
    ];

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
