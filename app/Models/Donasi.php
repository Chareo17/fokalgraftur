<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = [
        'nama',
        'gambar_donasi',
        'nominal',
        'status',
        'user_id',
        'user_type',
    ];

    public function user()
    {
        return $this->morphTo();
    }
}
