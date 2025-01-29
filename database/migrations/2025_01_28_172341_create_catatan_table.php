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
        Schema::create('catatan', function (Blueprint $table) {
            $table->id(); // Primary Key (Auto Increment)
            $table->unsignedBigInteger('id_proposal'); // Foreign Key
            $table->text('isi_catatan'); // Kolom teks panjang untuk catatan
            $table->string('role_pengirim'); // Role yang mengirim catatan
            $table->string('role_dituju'); // Role yang dituju
            $table->boolean('status')->default(false); // Status catatan (true/false)
            $table->timestamps(); // Kolom created_at & updated_at otomatis

            // Tambahkan foreign key constraint ke tabel proposals
            $table->foreign('id_proposal')
                  ->references('id')
                  ->on('proposals')
                  ->onDelete('cascade'); // Hapus catatan jika proposal dihapus
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan');
    }
};
