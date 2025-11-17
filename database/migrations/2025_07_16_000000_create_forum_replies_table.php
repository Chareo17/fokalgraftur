<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forum_topic_id');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->string('creator_role'); // 'admin', 'alumni', 'siswa'
            $table->text('reply_content');
            $table->timestamps();

            $table->foreign('forum_topic_id')->references('id')->on('forum_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_replies');
    }
}
