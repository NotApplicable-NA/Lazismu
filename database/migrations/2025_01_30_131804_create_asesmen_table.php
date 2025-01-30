<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asesmens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_assessment');
            $table->date('tanggal_assessment');
            $table->decimal('nominal_assessment', 15, 2); // Format angka desimal untuk uang
            $table->string('file_assessment')->nullable(); // Simpan nama file, nullable jika tidak ada file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesmens');
    }
};
