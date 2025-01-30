<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi untuk menambahkan kolom `program_pemohon`.
     */
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('program_pemohon')->nullable()->after('kategori'); // Menambahkan kolom baru
        });
    }

    /**
     * Rollback migrasi untuk menghapus kolom `program_pemohon`.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('program_pemohon'); // Menghapus kolom saat rollback
        });
    }
};

