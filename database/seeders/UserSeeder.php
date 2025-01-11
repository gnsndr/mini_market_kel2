<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'peran' => 'Admin', // Menyimpan peran ke kolom 'peran'
        ]);
        $admin->assignRole('Admin'); // Menetapkan role

        // Manajer Toko
        $manajer = User::create([
            'name' => 'Manajer Toko User',
            'email' => 'manajer@example.com',
            'password' => Hash::make('password123'),
            'peran' => 'Manajer Toko',
        ]);
        $manajer->assignRole('Manajer Toko'); // Menetapkan role

        // Supervisor
        $supervisor = User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@example.com',
            'password' => Hash::make('password123'),
            'peran' => 'Supervisor',
        ]);
        $supervisor->assignRole('Supervisor'); // Menetapkan role

        // Kasir
        $kasir = User::create([
            'name' => 'Kasir User',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password123'),
            'peran' => 'Kasir',
        ]);
        $kasir->assignRole('Kasir'); // Menetapkan role

        // Pegawai Gudang
        $pegawaiGudang = User::create([
            'name' => 'Pegawai Gudang User',
            'email' => 'pegawaigudang@example.com',
            'password' => Hash::make('password123'),
            'peran' => 'Pegawai Gudang',
        ]);
        $pegawaiGudang->assignRole('Pegawai Gudang'); // Menetapkan role
    }
}
