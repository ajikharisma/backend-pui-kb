<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {

            $table->string('id_rpph', 10)->after('id_indikator');

            // FOREIGN KEY
            $table->foreign('id_rpph')
                ->references('id_rpph')
                ->on('rpph')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('penilaian', function (Blueprint $table) {

            $table->dropForeign(['id_rpph']);

            $table->dropColumn('id_rpph');

        });
    }
};