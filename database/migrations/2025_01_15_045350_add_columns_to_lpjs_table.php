<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLpjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lpjs', function (Blueprint $table) {
            $table->string('nama_instansi'); // Tidak dapat null
            $table->decimal('dana_disetujui', 15, 2); // Tidak dapat null
            $table->decimal('total_pengeluaran', 15, 2); // Tidak dapat null
            $table->string('file_lpj'); // Tidak dapat null
            $table->text('keterangan_lpj')->nullable(); // Tetap dapat null
            $table->string('file_bukti_sisa_dana'); // Tidak dapat null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lpjs', function (Blueprint $table) {
            $table->dropColumn('nama_instansi');
            $table->dropColumn('dana_disetujui');
            $table->dropColumn('total_pengeluaran');
            $table->dropColumn('file_lpj');
            $table->dropColumn('keterangan_lpj');
            $table->dropColumn('file_bukti_sisa_dana');
        });
    }
}
