<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Mengubah enum kolom status menjadi: 'belum divalidasi', 'divalidasi', 'ditolak'
        DB::statement("ALTER TABLE donations MODIFY status ENUM('belum divalidasi', 'divalidasi', 'ditolak') DEFAULT 'belum divalidasi'");
    }

    public function down(): void
    {
        // Mengembalikan enum kolom status ke versi sebelumnya (misalnya hanya 2 opsi)
        DB::statement("ALTER TABLE donations MODIFY status ENUM('belum divalidasi', 'divalidasi') DEFAULT 'belum divalidasi'");
    }
};
