<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['create category', 'read category','update category','delete category','create product', 'read product','update product','delete product','confirm order','generate report'];

        foreach($permissions as $permission){
            Permission::create(['name'=> $permission, 'guard_name' => 'web']);
        }
    }
}
