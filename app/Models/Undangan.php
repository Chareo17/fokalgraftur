<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    use HasFactory;

    protected $table = 'undangan';

    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'role_target',
        'name',
        'gambar_barcode_tanda_tangan',
    ];

    protected $casts = [
        'role_target' => 'array',
    ];
}
