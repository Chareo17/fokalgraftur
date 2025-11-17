<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentoringTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoring', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('judul_mentoring');
            $table->text('deskripsi');
            $table->string('path_gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentoring');
    }
}
