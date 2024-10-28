<?php

namespace Database\Seeders;

use App\Models\Kontaks;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontaks::create([
            'kontak' => 6285654800639
        ]);
    }
}
