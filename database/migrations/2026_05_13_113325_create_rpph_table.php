<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rpph', function (Blueprint $table) {

            $table->string('id_rpph', 10)->primary();

            $table->string('tema');

            $table->string('sub_tema')->nullable();

            $table->string('minggu');

            $table->string('hari');

            $table->string('topik_harian');

            $table->string('semester');

            $table->string('tahun_ajaran');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rpph');
    }
};