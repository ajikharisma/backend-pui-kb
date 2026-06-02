<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asesmen', function (Blueprint $table) {

            $table->string('id_asesmen', 10)->primary();

            $table->string('nama_asesmen');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asesmen');
    }
};