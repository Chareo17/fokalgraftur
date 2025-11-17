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
        // Check if the table exists and has polymorphic structure
        if (Schema::hasTable('voucher_usages')) {
            $columns = Schema::getColumnListing('voucher_usages');

            // If we have polymorphic columns, convert back to user_id
            if (in_array('userable_type', $columns) && in_array('userable_id', $columns)) {
                Schema::table('voucher_usages', function (Blueprint $table) {
                    // Drop polymorphic indexes and constraints
                    try {
                        $table->dropUnique(['userable_type', 'userable_id', 'voucher_id']);
                    } catch (\Exception $e) {
                        // Constraint might not exist
                    }

                    try {
                        $table->dropIndex(['userable_type', 'userable_id']);
                    } catch (\Exception $e) {
                        // Index might not exist
                    }

                    try {
                        $table->dropIndex(['voucher_id']);
                    } catch (\Exception $e) {
                        // Index might not exist
                    }

                    // Drop polymorphic columns
                    $table->dropColumn(['userable_type', 'userable_id']);

                    // Add back the user_id column
                    $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

                    // Add back the unique constraint
                    $table->unique(['user_id', 'voucher_id']);
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This would convert back to polymorphic, but since we're reverting,
        // we'll keep it simple
        Schema::table('voucher_usages', function (Blueprint $table) {
            // Drop user_id constraint and column
            $table->dropUnique(['user_id', 'voucher_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // Add back polymorphic columns
            $table->string('userable_type')->nullable();
            $table->unsignedBigInteger('userable_id')->nullable();

            // Add back polymorphic constraints
            $table->index(['userable_type', 'userable_id']);
            $table->unique(['userable_type', 'userable_id', 'voucher_id']);
        });
    }
};
