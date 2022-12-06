<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'vinyl-list',
            'vinyl-create',
            'vinyl-edit',
            'vinyl-delete',
            'penjual-list',
            'penjual-create',
            'penjual-edit',
            'penjual-delete',
            'pembeli-list',
            'pembeli-create',
            'pembeli-edit',
            'pembeli-delete'

        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}