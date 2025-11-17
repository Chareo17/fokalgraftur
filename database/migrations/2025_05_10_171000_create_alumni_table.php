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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alamat')->nullable();
            $table->string('username')->unique();
            $table->string('jurusan')->nullable();
            $table->year('tahun_lulusan')->nullable();
            $table->string('nia')->unique()->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status', ['Bekerja', 'Tidak Bekerja', 'Studi Lanjut'])->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('nama_universitas')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('password');
            $table->boolean('digital_card_available')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
