<?php

namespace Database\Seeders;

use App\Models\Buku\Buku;
use App\Models\Buku\KategoriBuku;
use App\Models\Buku\PenerbitBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // $data  = [];

        for ($i = 0; $i < 50; $i++) {
            // $data[] = 
            Buku::insert(
                [
                    'judul'        => $faker->sentence(2),
                    'pengarang'    => $faker->name(),
                    'kategori'     => KategoriBuku::get()->random()->nama_kategori,
                    'penerbit'     => PenerbitBuku::get()->random()->nama_penerbit,
                    'tahun_terbit' => $faker->date("Y"),
                    'isbn'         => $faker->unique()->randomNumber(4,true),
                    'jumlah_buku'  => $faker->randomNumber(2,false),
                    'rak_buku'     => $faker->randomDigitNotNull(),
                    'created_at'   => now()->toDateTimeString(),
                    'updated_at'   => now()->toDateTimeString(),
                ]
            );
        }
    }
}
