<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi untuk menghapus tabel `asesmens`.
     */
    public function up(): void
    {
        Schema::dropIfExists('asesmens');
    }

    /**
     * Rollback migrasi untuk mengembalikan tabel `asesmens`.
     */
    public function down(): void
    {
        Schema::create('asesmens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_assessment');
            $table->date('tanggal_assessment');
            $table->decimal('nominal_assessment', 15, 2);
            $table->timestamps();
        });
    }
};

