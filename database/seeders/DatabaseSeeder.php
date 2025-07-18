<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call your ICTV seeder
        $this->call([
            IctvSeeder::class,
        ]);
    }
}
