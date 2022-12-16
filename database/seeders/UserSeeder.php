<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'  => 'Admin',
                'email' => 'admin@cogan.com',
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'password'   => Hash::make('admin'),
                'role'       => Role::Admin->value,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name'  => 'Zoel',
                'email' => 'zoel@cogan.com',
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'password'   => Hash::make('zoel'),
                'role'       => Role::User->value,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],

        ]);
    }
}
