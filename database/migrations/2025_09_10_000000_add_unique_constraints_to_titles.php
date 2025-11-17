<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintsToTitles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->unique('judul');
        });

        Schema::table('lowongan', function (Blueprint $table) {
            $table->unique('judul');
        });

        Schema::table('mentoring', function (Blueprint $table) {
            $table->unique('judul_mentoring');
        });

        Schema::table('forum_topics', function (Blueprint $table) {
            $table->unique('judul_topik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropUnique(['judul']);
        });

        Schema::table('lowongan', function (Blueprint $table) {
            $table->dropUnique(['judul']);
        });

        Schema::table('mentoring', function (Blueprint $table) {
            $table->dropUnique(['judul_mentoring']);
        });

        Schema::table('forum_topics', function (Blueprint $table) {
            $table->dropUnique(['judul_topik']);
        });
    }
}
