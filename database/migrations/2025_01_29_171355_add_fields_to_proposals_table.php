<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('sasaran_ashnaf', 50)->nullable()->after('pilar');
            $table->string('sumber_pendanaan', 50)->nullable()->after('sasaran_ashnaf');
            $table->decimal('jumlah_pendanaan', 15, 2)->nullable()->after('sumber_pendanaan');
            $table->string('pencairan_via', 50)->nullable()->after('jumlah_pendanaan');
            $table->integer('penerima_laki')->nullable()->after('pilar');
            $table->integer('penerima_perempuan')->nullable()->after('penerima_laki');
            $table->integer('penerima_total')->nullable()->after('penerima_perempuan');
        });
    }

    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn(['sasaran_ashnaf', 'sumber_pendanaan', 'jumlah_pendanaan', 'pencairan_via', 'penerima_laki', 'penerima_perempuan', 'penerima_total']);
        });
    }
};
