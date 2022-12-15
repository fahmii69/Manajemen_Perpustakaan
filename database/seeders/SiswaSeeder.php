<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
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
            $gender = $faker->randomElements(['Laki - laki', 'Perempuan'])[0];
            // $data[] =
            Siswa::insert(
                [
                    'nisn'          => $faker->unique()->randomNumber(4, false),
                    'nama'          => $faker->name($gender),
                    'tgl_lahir'     => $faker->date(),
                    'alamat'       => $faker->address(),
                    'kelas'         => $faker->randomElement(['a', 'b', 'c', 'd', 'e']),
                    'jenis_kelamin' => $gender,
                    'created_at'    => now()->toDateTimeString(),
                    'updated_at'    => now()->toDateTimeString(),
                ]
            );
        }
    }
}
