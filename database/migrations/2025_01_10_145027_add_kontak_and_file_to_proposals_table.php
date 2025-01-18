<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKontakAndFileToProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Menambahkan kolom kontak
            $table->string('kontak', 255)->nullable()->after('status');

            // Menambahkan kolom file untuk menyimpan nama file proposal
            $table->string('file', 255)->nullable()->after('kontak');
        });
    }

    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Menghapus kolom kontak
            $table->dropColumn('kontak');

            // Menghapus kolom file
            $table->dropColumn('file');
        });
    }
}
