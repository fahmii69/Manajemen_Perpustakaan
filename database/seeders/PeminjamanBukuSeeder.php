<?php

namespace Database\Seeders;

use App\Models\Buku\Buku;
use App\Models\Siswa;
use App\Models\Transaksi\PeminjamanDetail;
use App\Models\Transaksi\PeminjamanBuku;
use App\Models\User;
use Carbon\Carbon;
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
            $peminjaman = PeminjamanBuku::create(
                [
                    'user_id'     => 1,
                    // 'user_id'     => User::inRandomOrder()->first()->id,
                    'nama_siswa'  => Siswa::inRandomOrder()->first()->nama,
                    'tgl_pinjam'  => Carbon::today()->subDays(rand(0, 365)),
                    'tgl_kembali' => $faker->dateTimeInInterval('+1 week'),
                    'status'      => $faker->randomElements(['SEDANG_DIPINJAM', 'DIKEMBALIKAN'])[0],
                    'created_at'  => now()->toDateTimeString(),
                    'updated_at'  => now()->toDateTimeString(),
                ]
            );

            foreach (range(1, rand(1, 3)) as $k) {
                PeminjamanDetail::create([
                    'buku_id'       => rand(1, 25),
                    'peminjaman_id' => $peminjaman->id,
                    'status'        => $faker->randomElements(['SEDANG_DIPINJAM', 'HILANG', 'DIKEMBALIKAN'])[0],
                ]);
            }
        }
    }
}
