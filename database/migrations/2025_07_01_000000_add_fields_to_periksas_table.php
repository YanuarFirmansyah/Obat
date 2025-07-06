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
        Schema::table('periksas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_poli')->nullable()->after('id_dokter');
            $table->dateTime('jadwal')->nullable()->after('tgl_periksa');
            $table->text('keluhan')->nullable()->after('catatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            $table->dropColumn(['id_poli', 'jadwal', 'keluhan']);
        });
    }
};
