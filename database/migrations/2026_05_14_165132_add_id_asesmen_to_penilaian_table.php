<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {

            $table->string('id_asesmen', 10)->after('id_indikator');

            $table->foreign('id_asesmen')
                ->references('id_asesmen')
                ->on('asesmen')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {

            $table->dropForeign(['id_asesmen']);

            $table->dropColumn('id_asesmen');

        });
    }
};