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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->string('judul');
            $table->integer('diskon');
            $table->enum('tipe_diskon', ['percentage', 'fixed'])->default('percentage');
            $table->integer('minimal_belanja')->nullable();
            $table->date('tanggal_kadaluarsa');
            $table->text('deskripsi');
            $table->string('gambar')->nullable();
            $table->integer('batas_penggunaan')->nullable();
            $table->enum('status', ['active', 'expired', 'inactive'])->default('active');
            $table->unsignedBigInteger('dibuat_oleh')->nullable();
            $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('set null');
            $table->integer('jumlah_digunakan')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropForeign(['dibuat_oleh']);
            $table->dropColumn([
                'judul',
                'diskon',
                'tipe_diskon',
                'minimal_belanja',
                'tanggal_kadaluarsa',
                'deskripsi',
                'gambar',
                'batas_penggunaan',
                'status',
                'dibuat_oleh',
                'jumlah_digunakan'
            ]);
        });
    }
};
