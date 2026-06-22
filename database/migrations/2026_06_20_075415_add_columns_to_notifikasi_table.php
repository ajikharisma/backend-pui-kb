<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->string('id_anak', 10)->after('id_user');
            $table->string('judul')->after('id_anak');
            $table->enum('jenis', ['penilaian_harian', 'hasil_analisis'])->after('judul');

            $table->foreign('id_anak')->references('id_anak')->on('anak')->cascadeOnDelete();

            // Anti-spam: 1 anak hanya 1 notif "penilaian_harian" per tanggal
            $table->unique(['id_anak', 'jenis', 'tanggal'], 'unik_notif_harian');
        });
    }

    public function down(): void
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropUnique('unik_notif_harian');
            $table->dropForeign(['id_anak']);
            $table->dropColumn(['id_anak', 'judul', 'jenis']);
        });
    }
};