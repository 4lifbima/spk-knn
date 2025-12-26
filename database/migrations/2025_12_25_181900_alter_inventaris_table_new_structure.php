<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['kondisi', 'jumlah']);
        });

        Schema::table('inventaris', function (Blueprint $table) {
            // Add new columns
            $table->string('kondisi')->after('tahun'); // Baik, Rusak Ringan, Rusak Berat
            $table->string('tingkat_pemanfaatan')->after('kondisi'); // Sering Digunakan, Kadang Digunakan, Tidak Digunakan
            $table->string('tingkat_kebutuhan')->after('tingkat_pemanfaatan'); // Sangat Dibutuhkan, Dibutuhkan, Sangat Tidak Dibutuhkan
        });
    }

    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropColumn(['kondisi', 'tingkat_pemanfaatan', 'tingkat_kebutuhan']);
        });

        Schema::table('inventaris', function (Blueprint $table) {
            $table->integer('kondisi')->after('nama'); // 1-5
            $table->integer('jumlah')->after('kondisi');
        });
    }
};
