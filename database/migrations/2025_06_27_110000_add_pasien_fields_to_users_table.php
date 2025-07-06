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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'no_ktp')) {
                $table->string('no_ktp', 30)->unique()->nullable();
            }
            if (!Schema::hasColumn('users', 'no_rm')) {
                $table->string('no_rm', 20)->unique()->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'no_ktp')) {
                $table->dropColumn('no_ktp');
            }
            if (Schema::hasColumn('users', 'no_rm')) {
                $table->dropColumn('no_rm');
            }
        });
    }
};
