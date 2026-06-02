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
        Schema::create('indikator', function (Blueprint $table) {
            $table->string('id_indikator', 10)->primary();
            $table->string('id_aspek', 10);

            $table->text('nama_indikator');

            $table->foreign('id_aspek')->references('id_aspek')->on('aspek_perkembangan')->cascadeOnDelete();
            $table->timestamps(); // 🔥 FIX
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator');
    }
};
