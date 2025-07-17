<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ictv;

class IctvSeeder extends Seeder
{
    public function run(): void
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

        foreach ($episodes as $episode) {
            Ictv::create($episode);
        }
    }
}
