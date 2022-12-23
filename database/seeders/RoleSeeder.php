<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('role_has_permissions')->delete();

        DB::table('roles')->insert([
            'name'       => 'Admin',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name'       => 'User',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // DB::table('roles')->insert([
        //     'name'       => 'Admin',
        //     'guard_name' => 'api',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // DB::table('roles')->insert([
        //     'name'       => 'User',
        //     'guard_name' => 'api',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        $permissions = [
            [
                'name'       => 'peminjaman.index',
                'alias'      => 'Peminjaman Index',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'peminjaman.edit',
                'alias'      => 'Edit Peminjaman',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'peminjaman.create',
                'alias'      => 'Page Peminjaman',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'buku.edit',
                'alias'      => 'Edit Buku',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'buku.update',
                'alias'      => 'Update Buku',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'buku.create',
                'alias'      => 'Create Buku',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'buku.store',
                'alias'      => 'Add Buku',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'buku.delete',
                'alias'      => 'Delete Buku',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],
            [
                'name'       => 'kategori.index',
                'alias'      => 'Index Kategori',
                'guard_name' => 'web',
                'role'       => ['Admin'],
            ],

        ];

        foreach ($permissions as $k => $v) {
            DB::table('permissions')->insert([
                'name'       => $v['name'],
                'alias'      => $v['alias'],
                'guard_name' => $v['guard_name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if (in_array('Admin', $v['role'])) {
                $role = Role::findByName('Admin');
                $role->givePermissionTo($v['name']);
            }
        }
    }
}
