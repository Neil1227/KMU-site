<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IECMaterial;

class IECMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run()
{
    IECMaterial::insert([
        [
            'title' => 'Tilapia Supplement',
            'description' => 'Supplements aid tilapia farming by promoting growth, enhancing immunity, and improving feed efficiency.',
            'file' => 'Brochure-Tilapia_supplement.pdf',
            'png' => 'iec_tilapia_supplements.png',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Knowledge Management Unit',
            'description' => 'Where minds sit on the couch, ideas stir in a cup, and knowledge holds the mix.',
            'file' => 'KM-BROCHURE-FINAL.pdf',
            'png' => 'iec_km_brochure.png',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Challenges in Rice Production',
            'description' => 'A quick look into the key issues faced by rice farmers today.',
            'file' => 'CIRP_4.pdf',
            'png' => 'iec_CIRP.png',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'WEED MANAGEMENT STRATEGIES IN MODERN Crop Science',
            'description' => 'An overview of effective weed control techniques for sustainable crop production.',
            'file' => 'WMSIMCS-Brochure.pdf',
            'png' => 'iec_wmsimcs.png',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

}
