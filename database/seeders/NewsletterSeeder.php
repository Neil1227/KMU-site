<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Newsletter;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run()
{
    $newsletters = [
        [
            'file' => 'Innovation In Focus Quarter 4.pdf',
            'png' => 'NEWS_Innovation In Focus Q4.png',
            'title' => 'Innovation In Focus Quarter 4',
        ],
        [
            'file' => 'Innovation In Focus Quarter 3.pdf',
            'png' => 'NEWS_Innovation In Focus Q3.png',
            'title' => 'Innovation In Focus Quarter 3',
        ],
        [
            'file' => 'Innovation In Focus Quarter 2.pdf',
            'png' => 'NEWS_Issue 2 Quarter 2 Final.png',
            'title' => 'Innovation In Focus Quarter 2',
        ],
        [
            'file' => 'Innovation In Focus Quarter 1.pdf',
            'png' => 'NEWS_Innovation In Focus Q1.png',
            'title' => 'Innovation In Focus Quarter 1',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 2, Quarter 4.pdf',
            'png' => 'NEWS_IPTBM_(V2,Q4).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 4',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 2, Quarter 3.pdf',
            'png' => 'NEWS_IP-TBM in Focus (V2,Q3).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 3',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 2, Quarter 2.pdf',
            'png' => 'NEWS_IP-TBM in Focus (V2,Q2).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 2',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 2, Quarter 1.pdf',
            'png' => 'NEWS_IP-TBM in Focus (V2,Q1) (1).png',
            'title' => 'IPTBM In Focus, Volume 2, Quarter 1',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 1, Issue 3.pdf',
            'png' => 'NEWS_FINAL Q4.png',
            'title' => 'IPTBM In Focus, Volume 1, Issue 3',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 1, Issue 2.pdf',
            'png' => 'NEWS_IPTBM In Focus (Q3).png',
            'title' => 'IPTBM In Focus, Volume 1, Issue 2',
        ],
        [
            'file' => 'IPTBM In Focus, Volume 1, Issue 1.pdf',
            'png' => 'NEWS_IPTBM In Focus, Volume 1, Issue 1.png',
            'title' => 'IPTBM In Focus, Volume 1, Issue 1',
        ],
        [
            'file' => 'iec_brochure/NEWS_FINAL_2025 In Focus Q1.pdf',
            'png' => 'NEWS_FINAL_2025 In Focus Q1.png',
            'title' => 'In progress',
        ],
    ];
    foreach ($newsletters as $data) {
        Newsletter::create($data);
    }
}

}
