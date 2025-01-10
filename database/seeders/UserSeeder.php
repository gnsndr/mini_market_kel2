<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        // Membuat peran (Roles) jika belum ada
        $roles = ['Admin', 'Manajer Toko', 'Supervisor', 'Kasir', 'Pegawai Gudang'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);  // Menggunakan firstOrCreate untuk memastikan role ada
        }

        // Membuat pengguna dan menetapkan peran

        // Admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Gunakan Hash untuk menyimpan password
        ]);
        $admin->assignRole('Admin');  // Menetapkan peran Admin

        // Manajer Toko
        $manajer = User::create([
            'name' => 'Manajer Toko User',
            'email' => 'manajer@example.com',
            'password' => Hash::make('password123'),
        ]);
        $manajer->assignRole('Manajer Toko'); // Menetapkan peran Manajer Toko

        // Supervisor
        $supervisor = User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@example.com',
            'password' => Hash::make('password123'),
        ]);
        $supervisor->assignRole('Supervisor'); // Menetapkan peran Supervisor

        // Kasir
        $kasir = User::create([
            'name' => 'Kasir User',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password123'),
        ]);
        $kasir->assignRole('Kasir'); // Menetapkan peran Kasir

        // Pegawai Gudang
        $pegawaiGudang = User::create([
            'name' => 'Pegawai Gudang User',
            'email' => 'pegawaigudang@example.com',
            'password' => Hash::make('password123'),
        ]);
        $pegawaiGudang->assignRole('Pegawai Gudang'); // Menetapkan peran Pegawai Gudang
    }
}
