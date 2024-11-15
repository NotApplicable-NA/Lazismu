<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_mlo')->unsigned();
            $table->foreign('id_mlo')->references('id')->on('mlos')->onDelete('cascade');
            $table->string('judul');
            $table->string('kategori');
            $table->integer('anggaran');
            $table->date('tgl_masuk');
            $table->date('tgl_acc');
            $table->date('tgl_ambil_dana');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal');
    }
};
