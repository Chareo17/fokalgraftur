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
        // Check if the table exists and has the correct structure
        if (Schema::hasTable('voucher_usages')) {
            $columns = Schema::getColumnListing('voucher_usages');

            // If we have polymorphic columns, ensure they have proper indexes
            if (in_array('userable_type', $columns) && in_array('userable_id', $columns)) {
                Schema::table('voucher_usages', function (Blueprint $table) {
                    // Ensure indexes exist (these should not fail if they already exist)
                    try {
                        $table->index(['userable_type', 'userable_id']);
                    } catch (\Exception $e) {
                        // Index already exists, continue
                    }

                    try {
                        $table->index(['voucher_id']);
                    } catch (\Exception $e) {
                        // Index already exists, continue
                    }

                    // Check if we need to clean up any orphaned records
                    $this->cleanupOrphanedRecords();
                });
            }
        }
    }

    /**
     * Clean up any orphaned records that might be causing issues
     */
    private function cleanupOrphanedRecords()
    {
        // Remove any records with null userable_type or userable_id
        DB::table('voucher_usages')
            ->whereNull('userable_type')
            ->orWhereNull('userable_id')
            ->delete();

        // Remove any records where the referenced user doesn't exist
        $validUserTypes = ['App\\Models\\User', 'App\\Models\\Alumni', 'App\\Models\\Siswa', 'App\\Models\\Admin'];

        DB::table('voucher_usages')
            ->whereNotIn('userable_type', $validUserTypes)
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration only adds indexes, so rollback just removes them
        Schema::table('voucher_usages', function (Blueprint $table) {
            try {
                $table->dropIndex(['userable_type', 'userable_id']);
            } catch (\Exception $e) {
                // Index doesn't exist, continue
            }

            try {
                $table->dropIndex(['voucher_id']);
            } catch (\Exception $e) {
                // Index doesn't exist, continue
            }
        });
    }
};
