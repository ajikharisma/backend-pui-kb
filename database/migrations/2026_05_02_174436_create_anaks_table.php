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
        Schema::create('anak', function (Blueprint $table) {
            $table->string('id_anak', 10)->primary();
            $table->string('id_orang_tua', 10);

            $table->string('nama_anak');
            $table->string('kelompok');
            $table->date('tanggal_lahir');

            $table->foreign('id_orang_tua')->references('id_orang_tua')->on('orang_tua')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
