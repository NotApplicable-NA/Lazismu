<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTglAmbilDanaNullableInProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->date('tgl_ambil_dana')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->date('tgl_ambil_dana')->nullable(false)->change();
        });
    }
}