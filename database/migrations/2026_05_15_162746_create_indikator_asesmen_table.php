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
        Schema::create('indikator_asesmen', function (Blueprint $table) {

            $table->id();

            // RELASI KE INDIKATOR
            $table->string('id_indikator');

            // RELASI KE ASESMEN
            $table->string('id_asesmen');

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('id_indikator')
                  ->references('id_indikator')
                  ->on('indikator')
                  ->onDelete('cascade');

            $table->foreign('id_asesmen')
                  ->references('id_asesmen')
                  ->on('asesmen')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_asesmen');
    }
};