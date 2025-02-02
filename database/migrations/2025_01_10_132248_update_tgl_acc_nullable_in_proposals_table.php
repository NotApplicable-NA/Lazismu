<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTglAccNullableInProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->date('tgl_acc')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->date('tgl_acc')->nullable(false)->change();
        });
    }
}