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
        Schema::table('testimonis', function (Blueprint $table) {
            $table->string('nama_alumni');
            $table->string('jurusan');
            $table->year('tahun_lulusan');
            $table->string('posisi_pekerjaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->text('testimoni');
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonis', function (Blueprint $table) {
            $table->dropColumn(['nama_alumni', 'jurusan', 'tahun_lulusan', 'posisi_pekerjaan', 'nama_perusahaan', 'testimoni', 'foto']);
        });
    }
};
