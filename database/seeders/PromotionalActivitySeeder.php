<?php

namespace Database\Seeders;

use App\Models\PromotionalActivity;
use Illuminate\Database\Seeder;

class PromotionalActivitySeeder extends Seeder
{
    public function run(): void
    {
        PromotionalActivity::truncate(); // Optional: clears table before seeding

        for ($i = 1; $i <= 10; $i++) {
            PromotionalActivity::create([
                'title' => 'Promotional Title '.$i,
                'description' => 'This is a sample description for promotional activity #',
                'link' => 'https://www.facebook.com/',
                'png' => 'KMC Logo with white png'.'.png', // Just sample file name
            ]);
        }
    }
}
