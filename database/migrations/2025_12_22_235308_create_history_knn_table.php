<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('history_knn', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('k_value');
            $table->integer('input_kondisi');
            $table->integer('input_jumlah');
            $table->string('result'); // Layak Digunakan / Perlu Diganti
            $table->decimal('confidence', 5, 2);
            $table->json('neighbors'); // Store nearest neighbors data
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('history_knn');
    }
};