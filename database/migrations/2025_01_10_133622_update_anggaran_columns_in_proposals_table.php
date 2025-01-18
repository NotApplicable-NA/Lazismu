<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAnggaranColumnsInProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Ubah nama kolom 'anggaran' menjadi 'anggaran_diajukan'
            $table->renameColumn('anggaran', 'anggaran_diajukan');

            // Tambahkan kolom 'anggaran_disetujui' yang bisa menerima NULL
            $table->integer('anggaran_disetujui')->nullable()->after('anggaran_diajukan');
        });
    }

    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Kembalikan nama kolom menjadi 'anggaran'
            $table->renameColumn('anggaran_diajukan', 'anggaran');

            // Hapus kolom 'anggaran_disetujui'
            $table->dropColumn('anggaran_disetujui');
        });
    }
}
