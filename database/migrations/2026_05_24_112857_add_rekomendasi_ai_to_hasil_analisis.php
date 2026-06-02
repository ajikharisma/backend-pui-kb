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
        Schema::table('hasil_analisis', function (Blueprint $table) {
            $table->text('rekomendasi_ai')->nullable()->after('rekomendasi');
            $table->boolean('ai_generated')->default(false)->after('rekomendasi_ai');
            $table->timestamp('ai_generated_at')->nullable()->after('ai_generated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {
            // 🔥 WAJIB DIISI: Hapus kembali kolom jika migration di-rollback
            $table->dropColumn(['rekomendasi_ai', 'ai_generated', 'ai_generated_at']);
        });
    }
};
