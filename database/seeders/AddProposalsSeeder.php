<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proposal;

class AddProposalsSeeder extends Seeder
{
    public function run()
    {
        $currentCount = Proposal::count();
        $rowsToAdd = 13 - $currentCount;

        if ($rowsToAdd > 0) {
            for ($i = 1; $i <= $rowsToAdd; $i++) {
                Proposal::create([
                    'id_mitra' => 1,
                    'judul' => 'Proposal Tambahan ' . $i,
                    'kategori' => 'Kategori ' . $i,
                    'anggaran_diajukan' => rand(10000000, 50000000), // Kolom anggaran_diajukan
                    'anggaran_disetujui' => rand(0, 1) ? rand(1000000, 40000000) : null, // Kolom anggaran_disetujui
                    'tgl_masuk' => now()->subDays(rand(1, 30)),
                    'tgl_acc' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                    'tgl_ambil_dana' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                    'status' => ['Masuk', 'Diterima', 'Proses'][rand(0, 2)],
                ]);
            }
        }
    }
}