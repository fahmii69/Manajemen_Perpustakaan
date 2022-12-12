<?php

namespace Database\Seeders;

use App\Models\Buku\Buku;
use App\Models\Siswa;
use App\Models\Transaksi\PeminjamanBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PeminjamanBukuSeeder extends Seeder
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
            PeminjamanBuku::insert(
                [
                    'nama_siswa'  => Siswa::get()->random()->nama,
                    'buku_id'     => Buku::get()->random()->id,
                    'tgl_pinjam'  => $faker->date(),
                    'tgl_kembali' => $faker->dateTimeInInterval('+1 week'),
                    'status'      => $faker->randomElements(['Sedang dipinjam', 'Dikembalikan'])[0],
                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );
        }
    }
}
