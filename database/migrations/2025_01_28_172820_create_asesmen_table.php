<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('asesmen', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
            $table->unsignedBigInteger('id_proposal'); // Foreign Key ke tabel proposals
            $table->string('nama_asesmen'); // Nama asesmen
            $table->integer('nominal'); // Nominal asesmen
            $table->date('tanggal_asesmen'); // Tanggal asesmen
            $table->timestamps(); // Kolom created_at & updated_at otomatis

            // Tambahkan foreign key constraint ke tabel proposals
            $table->foreign('id_proposal')
                  ->references('id')
                  ->on('proposals')
                  ->onDelete('cascade'); // Hapus asesmen jika proposal dihapus
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmen');
    }
};
