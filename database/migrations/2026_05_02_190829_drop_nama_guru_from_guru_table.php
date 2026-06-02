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
        Schema::table('guru', function (Blueprint $table) {
            // Perintah untuk menghapus kolom
            $table->dropColumn('nama_guru');
        });
    }

    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            // Perintah untuk mengembalikan kolom jika di-rollback
            $table->string('nama_guru')->nullable();
        });
    }
};
