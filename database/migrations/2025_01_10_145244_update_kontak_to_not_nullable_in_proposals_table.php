<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateKontakToNotNullableInProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Mengubah kolom 'kontak' menjadi tidak boleh NULL
            $table->string('kontak', 255)->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Mengembalikan kolom 'kontak' menjadi bisa NULL
            $table->string('kontak', 255)->nullable()->change();
        });
    }
}
