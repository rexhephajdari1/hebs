<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_permission = [
            'admin' => ['create category', 'read category', 'update category', 'delete category', 'create product', 'read product', 'update product', 'delete product', 'confirm order', 'generate report'],
        ];

        foreach ($role_permission as $role => $permissions) {
            foreach ($permissions as $permission) {
                Role::where('name', $role)->first()->givePermissionTo($permission);
            }
        }
    }
}
