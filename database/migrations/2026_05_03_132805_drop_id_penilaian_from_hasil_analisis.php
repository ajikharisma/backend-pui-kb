<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {
            // 🔥 DROP FOREIGN KEY DULU
            $table->dropForeign(['id_penilaian']);

            // 🔥 BARU DROP KOLOM
            $table->dropColumn('id_penilaian');
        });
    }

    public function down()
    {
        Schema::table('hasil_analisis', function (Blueprint $table) {
            $table->string('id_penilaian');

            $table->foreign('id_penilaian')
                  ->references('id_penilaian')
                  ->on('penilaian')
                  ->onDelete('cascade');
        });
    }
};
