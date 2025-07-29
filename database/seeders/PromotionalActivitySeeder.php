<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\PromotionalActivity;

class PromotionalActivitySeeder extends Seeder
{
    public function run(): void
    {
        PromotionalActivity::truncate(); // Optional: clears table before seeding

        for ($i = 1; $i <= 10; $i++) {
            PromotionalActivity::create([
                'title' => 'Promotional Title ' . $i,
                'description' => 'This is a sample description for promotional activity #',
                'link' => 'https://www.facebook.com/',
                'png' => 'KMC Logo with white png' . '.png', // Just sample file name
            ]);
        }
    }
}
