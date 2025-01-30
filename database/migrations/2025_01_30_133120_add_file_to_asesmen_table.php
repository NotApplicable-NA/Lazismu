<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi untuk menambahkan kolom `file` ke tabel `asesmen`.
     */
    public function up(): void
    {
        Schema::table('asesmen', function (Blueprint $table) {
            $table->string('file')->nullable()->after('nominal'); // Menambahkan kolom file setelah nominal_assessment
        });
    }

    /**
     * Rollback migrasi untuk menghapus kolom `file`.
     */
    public function down(): void
    {
        Schema::table('asesmen', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
