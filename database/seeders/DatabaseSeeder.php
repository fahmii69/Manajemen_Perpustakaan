<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            SettingSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            KategoriBukuSeeder::class,
            PenerbitBukuSeeder::class,
            BukuSeeder::class,
            SiswaSeeder::class,
            PeminjamanBukuSeeder::class,
        ]);
    }
}
