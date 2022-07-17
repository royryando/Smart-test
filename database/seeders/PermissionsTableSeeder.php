<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission dashboard
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);

        //permission users
        Permission::create(['name' => 'users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'web']);

        //permission roles
        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);

        //permission permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);

        //permission categories
        Permission::create(['name' => 'kriteria.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'kriteria.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'kriteria.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'kriteria.delete', 'guard_name' => 'web']);

        //permission products
        Permission::create(['name' => 'nilai.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'nilai.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'nilai.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'nilai.delete', 'guard_name' => 'web']);

        //permission customers
        Permission::create(['name' => 'peserta.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'peserta.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'peserta.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'peserta.delete', 'guard_name' => 'web']);

        //permissions profites
        Permission::create(['name' => 'hasil.index', 'guard_name' => 'web']);
    }
}
