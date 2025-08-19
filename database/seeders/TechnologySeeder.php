<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        Technology::create([
            'product' => 'Tamarind Juice',
            'desc' => 'Our distinctive blend perfectly balances the tangy flavor of sour tamarind fruits with the lush sweetness of brown sugar. Combined with the subtle richness of dry active yeast and the refreshing clarity of mineral water, this mixture goes beyond typical flavors to enrich any dish it graces.',
            'net' => 50713134.60,
            'profit' => '55%',
            'image' => 'juice.png',
            'inventors' => [
                'Filomena K. Reyes',
                'Warlina M. Guzman',
                'Glenn M. Velasquez',
            ],
            'ip_status' => '2/2020/050418',
            'proposition' => [
                '100% Philippine product',
                'Made from the first-ever sweet tamarind variety registered in the Philippines',
                'Sold in an ergonomic plastic bottle',
            ],
            'benefits' => [
                'Rich in Antioxidants',
                'High in Calcium',
                'Heart-healthy',
                'Offers healthy benefits for the liver',
            ],
        ]);
    }
}
