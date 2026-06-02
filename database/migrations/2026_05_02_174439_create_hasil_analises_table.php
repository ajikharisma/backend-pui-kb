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
        Schema::create('hasil_analisis', function (Blueprint $table) {
            $table->string('id_hasil', 10)->primary();

            $table->string('id_anak', 10);
            $table->string('id_penilaian', 10);

            $table->string('periode');
            $table->string('status_perkembangan');
            $table->text('rekomendasi');
            $table->date('tanggal');

            $table->foreign('id_anak')->references('id_anak')->on('anak')->cascadeOnDelete();
            $table->foreign('id_penilaian')->references('id_penilaian')->on('penilaian')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_analisis');
    }
};
