<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proposal;

class ProposalSeeder extends Seeder
{
    public function run()
    {
        Proposal::create([
            'id_mitra' => 1,
            'judul' => 'Proposal Pembangunan Masjid',
            'kategori' => 'Keagamaan',
            'anggaran' => 50000000,
            'tgl_masuk' => now(),
            'tgl_acc' => null,
            'tgl_ambil_dana' => null,
            'status' => 'Proses',
        ]);

        Proposal::create([
            'id_mitra' => 1,
            'judul' => 'Proposal Pengadaan Alat Musik',
            'kategori' => 'Budaya',
            'anggaran' => 30000000,
            'tgl_masuk' => now(),
            'tgl_acc' => now()->addDays(5),
            'tgl_ambil_dana' => null,
            'status' => 'Diterima',
        ]);

        Proposal::create([
            'id_mitra' => 1,
            'judul' => 'Proposal Bantuan Pendidikan',
            'kategori' => 'Pendidikan',
            'anggaran' => 20000000,
            'tgl_masuk' => now()->subDays(10),
            'tgl_acc' => now()->subDays(5),
            'tgl_ambil_dana' => null,
            'status' => 'Diterima',
        ]);

        Proposal::create([
            'id_mitra' => 1,
            'judul' => 'Proposal Bantuan Bencana Alam',
            'kategori' => 'Sosial',
            'anggaran' => 100000000,
            'tgl_masuk' => now()->subDays(20),
            'tgl_acc' => now()->subDays(15),
            'tgl_ambil_dana' => now()->subDays(10),
            'status' => 'Diterima',
        ]);

        Proposal::create([
            'id_mitra' => 1,
            'judul' => 'Proposal Pelatihan Wirausaha',
            'kategori' => 'Ekonomi',
            'anggaran' => 40000000,
            'tgl_masuk' => now()->subDays(30),
            'tgl_acc' => now()->subDays(25),
            'tgl_ambil_dana' => null,
            'status' => 'Diterima',
        ]);
    }
}

