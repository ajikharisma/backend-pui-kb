<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {
            $table->dropColumn('rekomendasi');
        });
    }

    public function down(): void
    {
        // Kalau di-rollback, kolom dikembalikan
        Schema::table('hasil_analisis', function (Blueprint $table) {
            $table->text('rekomendasi')->nullable()->after('indikator_lemah');
        });
    }
};