<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Siswa;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KategoriBukuSeeder::class,
            PenerbitBukuSeeder::class,
            BukuSeeder::class,
            SiswaSeeder::class,
        ]);
    }
}
