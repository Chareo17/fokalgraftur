<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_topics', function (Blueprint $table) {
            $table->id();
            $table->string('judul_topik');
            $table->text('isi_topik');
            $table->enum('kategori', ['umum', 'karier', 'pendidikan']);
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->string('creator_role'); // 'admin', 'alumni', 'siswa'
            $table->timestamps();

            // Foreign key constraints can be added if needed, depending on creator_role
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_topics');
    }
}
