<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'name'  => 'nominal_denda',
                'description' => 'Denda Terlambat',
                'value' => '15000',
            ],
            [
                'name'  => 'nama_perpus',
                'description' => 'Nama Perpus',
                'value' => 'Perpustakan Zoel',
            ],
            [
                'name'  => 'alamat',
                'description' => 'Alamat',
                'value' => 'Jalan Sesama',
            ],
            [
                'name'  => 'email',
                'description' => 'Email',
                'value' => 'zoel@cogan.com',
            ],
            [
                'name'  => 'telepon',
                'description' => 'No Telepon',
                'value' => '081234567890',
            ],
            [
                'name'  => 'limit_hari_pinjam',
                'description' => 'Limit hari pinjam',
                'value' => '7',
            ],
        ]);
    }
}
