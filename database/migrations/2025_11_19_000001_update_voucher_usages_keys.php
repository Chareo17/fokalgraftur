<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('voucher_usages', function (Blueprint $table) {
            // Drop foreign key on user_id if exists
            try {
                $table->dropForeign(['user_id']);
            } catch (\Throwable $e) {
                // ignore if not exists
            }

            // Drop old unique index on (user_id, voucher_id) if exists
            // Common auto-generated name in MySQL is 'voucher_usages_user_id_voucher_id_unique'
            try {
                $table->dropUnique('voucher_usages_user_id_voucher_id_unique');
            } catch (\Throwable $e) {
                // Fallback: try dropping by columns if supported
                try {
                    $table->dropUnique(['user_id', 'voucher_id']);
                } catch (\Throwable $e2) {
                    // ignore if still not exists
                }
            }
        });

        // Add new unique compound index including user_type
        Schema::table('voucher_usages', function (Blueprint $table) {
            try {
                $table->unique(['voucher_id', 'user_id', 'user_type'], 'voucher_usages_voucher_user_usertype_unique');
            } catch (\Throwable $e) {
                // ignore if already exists
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('voucher_usages', function (Blueprint $table) {
            // Drop new unique index
            try {
                $table->dropUnique('voucher_usages_voucher_user_usertype_unique');
            } catch (\Throwable $e) {
                try {
                    $table->dropUnique(['voucher_id', 'user_id', 'user_type']);
                } catch (\Throwable $e2) {
                    // ignore
                }
            }
        });

        Schema::table('voucher_usages', function (Blueprint $table) {
            // Restore old unique
            try {
                $table->unique(['user_id', 'voucher_id']);
            } catch (\Throwable $e) {
                // ignore
            }

            // Restore foreign key to users table
            try {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            } catch (\Throwable $e) {
                // ignore
            }
        });
    }
};
