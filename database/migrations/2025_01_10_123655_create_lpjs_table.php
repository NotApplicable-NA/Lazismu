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
        Schema::create('lpjs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_proposal')->unsigned();
            $table->foreign('id_proposal')->references('id')->on('proposals')->onDelete('cascade');
            $table->string('judul_lpj');
            $table->date('tgl_masuk');
            $table->date('tgl_acc');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpj');
    }
};
