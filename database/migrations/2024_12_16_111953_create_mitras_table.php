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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('password');
            $table->string('no_hp');
            $table->string('email');
            $table->string('alamat');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_mitras', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};