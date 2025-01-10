<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Membuat Permission
        $permissions = [
            'view_products',
            'manage_products',
            'view_transactions',
            'process_transactions',
            'view_stocks',
            'manage_stocks',
            'view_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Membuat Role
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $manager = Role::firstOrCreate(['name' => 'Manajer Toko']);
        $supervisor = Role::firstOrCreate(['name' => 'Supervisor']);
        $cashier = Role::firstOrCreate(['name' => 'Kasir']);
        $warehouse = Role::firstOrCreate(['name' => 'Pegawai Gudang']);

        // Menetapkan permissions pada role
        $admin->givePermissionTo(Permission::all()); // Admin memiliki semua permission

        // Manajer Toko
        $manager->givePermissionTo([
            'view_products',
            'manage_products',
            'view_transactions',
            'view_reports',
        ]);

        // Supervisor
        $supervisor->givePermissionTo([
            'view_products',
            'view_transactions',
        ]);

        // Kasir
        $cashier->givePermissionTo([
            'process_transactions',
        ]);

        // Pegawai Gudang
        $warehouse->givePermissionTo([
            'view_stocks',
            'manage_stocks',
        ]);
    }
}
