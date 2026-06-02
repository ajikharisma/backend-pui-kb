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
        Schema::dropIfExists('hasil_analisis');

        Schema::create('hasil_analisis', function (Blueprint $table) {
            $table->string('id_hasil', 10)->primary();

            $table->string('id_anak', 10);
            $table->string('id_rpph', 10);
            $table->string('id_aspek', 10);

            $table->string('nilai_dominan', 5);
            $table->string('status_perkembangan');

            $table->integer('jumlah_bb')->default(0);
            $table->integer('jumlah_mb')->default(0);
            $table->integer('jumlah_bsh')->default(0);
            $table->integer('jumlah_bsb')->default(0);
            $table->integer('total_penilaian')->default(0);
            $table->decimal('confidence', 5, 2)->default(0);

            $table->text('indikator_lemah')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('periode');
            $table->date('tanggal_analisis');

            $table->foreign('id_anak')->references('id_anak')->on('anak')->cascadeOnDelete();
            $table->foreign('id_rpph')->references('id_rpph')->on('rpph')->cascadeOnDelete();
            $table->foreign('id_aspek')->references('id_aspek')->on('aspek_perkembangan')->cascadeOnDelete();

            $table->unique(['id_anak', 'id_rpph', 'id_aspek']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_analisis');
    }
};
