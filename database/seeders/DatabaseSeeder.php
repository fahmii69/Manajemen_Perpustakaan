<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Siswa;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Spatie\LaravelIgnition\Support\Composer\FakeComposer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');
        $data  = [];

        for ($i = 0; $i < 15; $i++) {
            $gender = $faker->randomElements(['Laki-laki', 'Perempuan'])[0];
            $data[] = [
                'nisn'          => $faker->randomNumber(4, false),
                'nama'          => $faker->name($gender),
                'tgl_lahir'     => $faker->date(),
                'kelas'         => $faker->randomElement(['a', 'b', 'c', 'd', 'e']),
                'jenis_kelamin' => $gender,
                'created_at'    => now()->toDateTimeString(),
                'updated_at'    => now()->toDateTimeString(),
            ];
        }
        Siswa::insert($data);
    }
}
