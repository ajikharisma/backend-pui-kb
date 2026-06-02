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
        Schema::create('catatan_orang_tua', function (Blueprint $table) {
            $table->string('id_catatan', 10)->primary();

            $table->string('id_anak', 10);
            $table->string('id_orang_tua', 10);

            $table->string('judul_catatan');
            $table->text('isi_catatan');
            $table->date('tanggal');

            $table->foreign('id_anak')->references('id_anak')->on('anak')->cascadeOnDelete();
            $table->foreign('id_orang_tua')->references('id_orang_tua')->on('orang_tua')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_orang_tua');
    }
};
