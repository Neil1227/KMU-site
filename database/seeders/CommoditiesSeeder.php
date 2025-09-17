<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commodity;

class CommoditiesSeeder extends Seeder
{
public function run(): void
{
    $path = storage_path('app/for-csv.csv');
    $handle = fopen($path, 'r');

    // Read header row
    $header = fgetcsv($handle);

    while (($row = fgetcsv($handle)) !== false) {
        // Skip empty rows
        if (count(array_filter($row)) === 0) {
            continue;
        }

        // Only combine if counts match
        if (count($header) === count($row)) {
            $data = array_combine($header, $row);

            \App\Models\Commodity::create([
                'commodity'           => $data['Commodity'] ?? null,
                'thesis_title'        => $data['Thesis title'] ?? null,
                'technologies'        => $data['Technologies'] ?? null,
                'technology_generator'=> $data['Technology Generator'] ?? null,
                'contact_info'        => $data['Contact Info'] ?? null,
                'type_of_technology'  => $data['Type of Technology'] ?? null,
                'ip_status'           => $data['IP Status'] ?? null,
                'trl_level'           => $data['TRL level'] ?? null,
                'sdgs'                => $data['SDGs'] ?? null,
                'remarks'             => $data['Remarks'] ?? null,
                'recommendations'     => $data['Recommendations'] ?? null,
                'link'                => $data['Link'] ?? null,
                'priority_area'       => $data['Priority Area'] ?? null,
            ]);
        } else {
            // Debug mismatched rows
            dump("Row mismatch: ", $row);
        }
    }

    fclose($handle);
}

}
