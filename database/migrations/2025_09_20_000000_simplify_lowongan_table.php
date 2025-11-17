<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SimplifyLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lowongan', function (Blueprint $table) {
            // Drop columns except 'id', 'judul', 'deskripsi', 'gambar', 'name', and timestamps
            $table->dropColumn([
                'lokasi',
                'pendidikan',
                'usia',
                'jenis_kelamin',
                'pengalaman',
                //'gambar', // keep gambar column
                'link_form',
                'no_whatsapp',
                'jam_kerja',
            ]);
            // Ensure 'name' column exists, add if missing
            if (!Schema::hasColumn('lowongan', 'name')) {
                $table->string('name')->nullable()->after('judul');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lowongan', function (Blueprint $table) {
            // Recreate dropped columns
            $table->string('lokasi');
            $table->string('pendidikan');
            $table->integer('usia');
            $table->string('jenis_kelamin');
            $table->integer('pengalaman');
            //$table->string('gambar'); // keep gambar column
            $table->text('link_form');
            $table->string('no_whatsapp');
            $table->string('jam_kerja');
            // Ensure 'name' column exists on rollback
            if (!Schema::hasColumn('lowongan', 'name')) {
                $table->string('name')->nullable()->after('judul');
            }
        });
    }
}
