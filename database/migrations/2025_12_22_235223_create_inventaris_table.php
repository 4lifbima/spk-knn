<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('kondisi'); // 1-5
            $table->integer('jumlah');
            $table->year('tahun');
            $table->string('status'); // Layak, Perlu Diganti, Perawatan
            $table->decimal('status_val', 3, 1)->default(1); // 0, 0.5, 1
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};