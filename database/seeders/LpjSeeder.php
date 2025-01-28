<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LpjSeeder extends Seeder
{
    public function run()
    {
        $lpjs = [
            [
                'id_proposal' => 2,
                'judul_lpj' => 'Laporan LPJ Proposal 1',
                'tgl_masuk' => '2024-01-10',
                'tgl_acc' => now(),
                'status' => 'Disetujui',
                'nama_instansi' => 'Instansi A',
                'dana_disetujui' => 1000000.00,
                'total_pengeluaran' => 750000.00,
                'file_lpj' => 'lpj_1.pdf',
                'keterangan_lpj' => 'Laporan penggunaan dana sesuai proposal',
                'file_bukti_sisa_dana' => 'bukti_1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_proposal' => 3,
                'judul_lpj' => 'Laporan LPJ Proposal 2',
                'tgl_masuk' => '2024-01-12',
                'tgl_acc' => now(),
                'status' => 'Menunggu Verifikasi',
                'nama_instansi' => 'Instansi B',
                'dana_disetujui' => 1500000.00,
                'total_pengeluaran' => 1300000.00,
                'file_lpj' => 'lpj_2.pdf',
                'keterangan_lpj' => 'Dana telah digunakan sesuai kebutuhan',
                'file_bukti_sisa_dana' => 'bukti_2.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lainnya hingga total 15 data
        ];

        for ($i = 3; $i <= 15; $i++) {
            $lpjs[] = [
                'id_proposal' => rand(25, 44), // Hanya memilih ID yang ada di tabel proposals
                'judul_lpj' => 'Laporan LPJ Proposal ' . $i,
                'tgl_masuk' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
                'tgl_acc' => Carbon::now(),
                'status' => ['Disetujui', 'Menunggu Verifikasi', 'Ditolak'][rand(0, 2)],
                'nama_instansi' => 'Instansi ' . chr(64 + $i), // A, B, C, ...
                'dana_disetujui' => rand(500000, 5000000),
                'total_pengeluaran' => rand(400000, 4900000),
                'file_lpj' => 'lpj_' . $i . '.pdf',
                'keterangan_lpj' => 'Laporan penggunaan dana untuk proposal ' . $i,
                'file_bukti_sisa_dana' => 'bukti_' . $i . '.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('lpjs')->insert($lpjs);
    }
}
