<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(StatusSeeder::class);

        // Buat 3 role aplikasi
        Role::firstOrCreate(['name' => 'admin',     'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'operator',  'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'pelanggan', 'guard_name' => 'web']);

        // Buat user admin utama
        $admin = User::factory()->create([
            'name'     => 'Admin',
            'nomor_hp' => '08514833966',
            'alamat'   => 'Jl. Kopo',
            'email'    => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        // Buat user operator contoh
        $operator = User::factory()->create([
            'name'     => 'Operator',
            'nomor_hp' => '08123456789',
            'alamat'   => 'Jl. Sudirman',
            'email'    => 'operator@example.com',
        ]);
        $operator->assignRole('operator');

        // Buat user pelanggan contoh
        $pelanggan = User::factory()->create([
            'name'     => 'Pelanggan',
            'nomor_hp' => '08987654321',
            'alamat'   => 'Jl. Merdeka',
            'email'    => 'pelanggan@example.com',
        ]);
        $pelanggan->assignRole('pelanggan');
    }
}
