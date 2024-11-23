<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
        $role = Role::create(['name' => 'Super Admin']);

        $role->givePermissionTo([
            'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete'
        ]);
    }
}