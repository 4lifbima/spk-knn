<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_knn', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['input_kondisi', 'input_jumlah']);
        });

        Schema::table('history_knn', function (Blueprint $table) {
            // Add new columns for 3 variables
            $table->string('input_kondisi')->after('k_value'); // Baik, Rusak Ringan, Rusak Berat
            $table->string('input_pemanfaatan')->after('input_kondisi'); // Sering Digunakan, Kadang Digunakan, Tidak Digunakan
            $table->string('input_kebutuhan')->after('input_pemanfaatan'); // Sangat Dibutuhkan, Dibutuhkan, Sangat Tidak Dibutuhkan
        });
    }

    public function down(): void
    {
        Schema::table('history_knn', function (Blueprint $table) {
            $table->dropColumn(['input_kondisi', 'input_pemanfaatan', 'input_kebutuhan']);
        });

        Schema::table('history_knn', function (Blueprint $table) {
            $table->integer('input_kondisi')->after('k_value');
            $table->integer('input_jumlah')->after('input_kondisi');
        });
    }
};
