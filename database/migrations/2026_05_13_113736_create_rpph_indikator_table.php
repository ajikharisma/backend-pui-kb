<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rpph_indikator', function (Blueprint $table) {

            $table->id();

            $table->string('id_rpph', 10);

            $table->string('id_indikator', 10);

            $table->timestamps();

            // FK
            $table->foreign('id_rpph')
                ->references('id_rpph')
                ->on('rpph')
                ->onDelete('cascade');

            $table->foreign('id_indikator')
                ->references('id_indikator')
                ->on('indikator')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rpph_indikator');
    }
};