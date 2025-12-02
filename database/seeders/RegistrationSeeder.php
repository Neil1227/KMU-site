<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/registeredip.csv');

        if (!file_exists($path)) {
            dd("CSV file not found: $path");
        }

        $file = fopen($path, 'r');

        // Skip header row
        $header = fgetcsv($file);

while (($row = fgetcsv($file)) !== false) {

    // Skip invalid rows
    if (count($row) < 6) continue;

    // Convert date
    $parsedDate = null;
    if (!empty($row[3])) {
        $parsedDate = date('Y-m-d', strtotime($row[3]));
    }

    Registration::create([
        'registration_number' => $row[0] ?? null,
        'title'               => $row[1] ?? null,
        'remarks'             => $row[2] ?? null,
        'date_received'       => $parsedDate,
        'inventor_owner'      => $row[4] ?? null,
        'ip_type'             => $row[5] ?? null,
        'notice'             => $row[6] ?? null,
    ]);
}


        fclose($file);
    }
}
