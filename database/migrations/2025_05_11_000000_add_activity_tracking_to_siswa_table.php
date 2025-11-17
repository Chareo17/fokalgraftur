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
        Schema::table('siswa', function (Blueprint $table) {
            $table->timestamp('last_login_at')->nullable()->after('password');
            $table->boolean('is_online')->default(false)->after('last_login_at');
            $table->timestamp('last_activity_at')->nullable()->after('is_online');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['last_login_at', 'is_online', 'last_activity_at']);
        });
    }
};
