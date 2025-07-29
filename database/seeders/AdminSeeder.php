<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    Admin::create([
        'user' => 'kmu2025',
        'password' => Hash::make('ictrd@2025')
    ]);
}
}
