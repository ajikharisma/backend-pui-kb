<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anak', function (Blueprint $table) {

            $table->string('foto')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('anak', function (Blueprint $table) {

            $table->dropColumn([
                'foto',
                'tempat_lahir',
                'jenis_kelamin'
            ]);

        });
    }
};