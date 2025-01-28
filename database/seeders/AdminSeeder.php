<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'id' => 1,
                'username' => 'admin1',
                'password' => Hash::make('password123'), // Ganti password sesuai kebutuhan
                'nama' => 'Admin Satu',
                'email' => 'admin1@example.com',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'username' => 'admin2',
                'password' => Hash::make('password456'),
                'nama' => 'Admin Dua',
                'email' => 'admin2@example.com',
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan akun admin lainnya sesuai kebutuhan
        ]);
    }
}
