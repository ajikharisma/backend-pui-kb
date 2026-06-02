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
            // Tambahkan kolom di sini
            $table->string('nama_guru')->nullable()->after('id_guru'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guru', function (Blueprint $table) {
            // Hapus kolom jika migration di-rollback
            $table->dropColumn('nama_guru');
        });
    }
};
