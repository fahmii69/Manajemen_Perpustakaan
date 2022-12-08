<?php

namespace Database\Seeders;

use App\Models\Buku\PenerbitBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenerbitBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PenerbitBuku::factory(10)->create();
    }
}
