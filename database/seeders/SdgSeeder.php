<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sdg;
use App\Models\SDGMedia;

class SdgSeeder extends Seeder
{
    public function run(): void
    {
        $sdgs = Sdg::all();

        foreach ($sdgs as $sdg) {

            // Seed 3 images per SDG
            for ($i = 1; $i <= 3; $i++) {

                SDGMedia::create([
                    'sdg_id' => $sdg->id,
                    'title' => "SDG {$sdg->sdg_number} – Sample Project {$i}",
                    'image' => "sdgs/logos-bg.png", // Change later if needed
                    'sdg_targets' => "{$sdg->sdg_number}.1, {$sdg->sdg_number}.2",
                ]);
            }
        }
    }
}
