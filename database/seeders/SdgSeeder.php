<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SdgSeeder extends Seeder
{
    public function run(): void
    {
        $sdgs = [
            1 => 'No Poverty: Pampanga State Agricultural University (PSAU) stands at the forefront of driving sustainable development, deeply committed to addressing SDG 1: No Poverty through research-driven programs, community empowerment, and agricultural innovations.',
            2 => 'Zero Hunger: PSAU actively contributes to SDG 2 by doubling agricultural productivity, supporting small-scale food producers, and developing innovative food technologies.',
            3 => 'Good Health and Well-being: PSAU promotes nutritious food, health programs, and research on public health to enhance community well-being.',
            4 => 'Quality Education: PSAU provides inclusive, high-quality education, training, and outreach programs to empower students and communities.',
            5 => 'Gender Equality: PSAU supports equal opportunities for women in leadership, education, and community development through inclusive policies and GAD initiatives.',
            6 => 'Clean Water and Sanitation: PSAU promotes sustainable water management, hygiene education, and eco-friendly water solutions.',
            7 => 'Affordable and Clean Energy: PSAU encourages renewable energy use, research, and community awareness programs.',
            8 => 'Decent Work and Economic Growth: PSAU equips graduates with skills for employment, entrepreneurship, and sustainable livelihoods.',
            9 => 'Industry, Innovation, and Infrastructure: PSAU fosters technological advancement and rural development through research and community engagement.',
            10 => 'Reduced Inequalities: PSAU advocates for inclusive education, community empowerment, and equal opportunities for marginalized groups.',
            11 => 'Sustainable Cities and Communities: No content available.',
            12 => 'Responsible Consumption and Production: No content available.',
            13 => 'Climate Action: No content available.',
            14 => 'Life Below Water: No content available.',
            15 => 'Life on Land: No content available.',
            16 => 'Peace, Justice, and Strong Institutions: No content available.',
            17 => 'Partnerships for the Goals: No content available.',
        ];

        foreach ($sdgs as $number => $description) {
            DB::table('sdgs')->insert([
                'sdg_number' => $number,
                'description' => $description,
                'gallery_link' => url("sdg-gallery/$number"),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
