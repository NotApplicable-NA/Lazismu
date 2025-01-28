<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProposalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Diterima', 'Ditolak', 'Menunggu'];
        $pilars = ['Pendidikan', 'Kemanusiaan', 'Dakwah', 'Ekonomi', 'Kesehatan', 'Lingkungan'];
        $categories = ['Proposal Umum', 'Proposal Khusus'];

        // Ambil semua ID valid dari tabel mitras
        $idMitraRange = DB::table('mitras')->pluck('id')->toArray();

        if (empty($idMitraRange)) {
            $this->command->error('Tabel mitras kosong! Pastikan ada data di tabel mitras sebelum menjalankan seeder ini.');
            return;
        }

        $proposals = [];
        $currentDate = Carbon::create(2025, 1, 1); // Januari 2025

        for ($i = 0; $i < 20; $i++) {
            // Tentukan tanggal random dalam 12 bulan terakhir
            $randomDate = $currentDate->copy()->subMonths(rand(0, 11))->startOfMonth()->addDays(rand(0, 27));

            $proposals[] = [
                'id_mitra' => $idMitraRange[array_rand($idMitraRange)], // Pilih ID mitra valid
                'judul' => 'Proposal ' . ($i + 1),
                'kategori' => $categories[array_rand($categories)],
                'pilar' => $pilars[array_rand($pilars)], // Ambil pilar dari daftar yang diberikan
                'anggaran_diajukan' => rand(1000000, 50000000), // Anggaran dalam rentang 1 juta - 50 juta
                'anggaran_disetujui' => rand(1000000, 50000000),
                'tgl_masuk' => $randomDate->format('Y-m-d'),
                'tgl_acc' => rand(0, 1) ? $randomDate->copy()->addDays(rand(1, 10))->format('Y-m-d') : null,
                'tgl_ambil_dana' => rand(0, 1) ? $randomDate->copy()->addDays(rand(11, 20))->format('Y-m-d') : null,
                'status' => $statuses[array_rand($statuses)],
                'kontak' => 'kontak' . ($i + 1) . '@example.com',
                'file' => 'proposal' . ($i + 1) . '.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('proposals')->insert($proposals);
    }
}
