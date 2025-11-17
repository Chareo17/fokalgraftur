<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganSekolah extends Model
{
    use HasFactory;

    protected $table = 'perkembangan_sekolah';

    protected $fillable = [
        'title',
        'description',
        'images',
        'tanggal_publikasi',
    ];
}
