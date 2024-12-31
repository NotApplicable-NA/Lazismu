<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mitra;

class MitraSeeder extends Seeder
{
    public function run()
    {
        Mitra::create([
            'nama' => 'Admin Mitra',
            'password' => 'password123',
            'no_hp' => '081234567890',
            'email' => 'admin@mitra.com',
            'alamat' => 'Jalan Mitra Utama',
            'status' => 1, // Active
        ]);

        Mitra::create([
            'nama' => 'User Mitra',
            'password' => 'userpassword',
            'no_hp' => '082345678901',
            'email' => 'user1@mitra.com',
            'alamat' => 'Jalan User Mitra',
            'status' => 0, // Inactive
        ]);

        Mitra::create([
            'nama' => 'Guest Mitra',
            'password' => 'guestpassword',
            'no_hp' => '083456789012',
            'email' => 'guest@mitra.com',
            'alamat' => 'Jalan Guest Mitra',
            'status' => 1, // Active
        ]);

        Mitra::create([
            'nama' => 'Akun Baru',
            'password' => 'qwertyuiop',
            'no_hp' => '083456789012',
            'email' => 'newemail@gmail.com',
            'alamat' => 'Jalan Guest Mitra',
            'status' => 1, // Active
        ]);
    }
}

?>
