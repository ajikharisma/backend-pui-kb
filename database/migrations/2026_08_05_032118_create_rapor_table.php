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
        Schema::create('rapor', function (Blueprint $table) {
            $table->string('id_rapor', 10)->primary();
            $table->string('id_anak', 10);
            $table->string('semester'); // "Semester Genap 2025/2026"
            $table->string('tahun_ajaran'); // "2024/2025"
            $table->string('fase')->default('FONDASI');

            // Narasi per aspek (generate Gemini, bisa diedit guru)
            $table->text('narasi_nabp_1')->nullable(); // 4 poin NABP
            $table->text('narasi_nabp_2')->nullable();
            $table->text('narasi_nabp_3')->nullable();
            $table->text('narasi_nabp_4')->nullable();

            $table->text('narasi_jd_1')->nullable();   // 4 poin JD
            $table->text('narasi_jd_2')->nullable();
            $table->text('narasi_jd_3')->nullable();
            $table->text('narasi_jd_4')->nullable();

            $table->text('narasi_lmstrs_1')->nullable(); // 7 poin LMSTRS
            $table->text('narasi_lmstrs_2')->nullable();
            $table->text('narasi_lmstrs_3')->nullable();
            $table->text('narasi_lmstrs_4')->nullable();
            $table->text('narasi_lmstrs_5')->nullable();
            $table->text('narasi_lmstrs_6')->nullable();
            $table->text('narasi_lmstrs_7')->nullable();

            // DDTK (isi manual)
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('lingkar_kepala')->nullable();

            // Presensi (isi manual)
            $table->integer('hadir')->default(0);
            $table->integer('sakit')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('tanpa_keterangan')->default(0);

            // Status
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->string('id_guru', 10)->nullable();

            $table->foreign('id_anak')->references('id_anak')->on('anak')->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
