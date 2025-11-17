<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('name')->nullable();
            $table->string('lokasi');
            $table->string('pendidikan');
            $table->integer('usia');
            $table->string('jenis_kelamin');
            $table->integer('pengalaman');
            $table->text('deskripsi');
            $table->string('gambar');
            $table->text('link_form');
            $table->string('no_whatsapp');
            $table->string('jam_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan');
    }
}
