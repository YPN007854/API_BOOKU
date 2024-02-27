<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $primaryKey = 'bukuid';
    protected $guarded = ['bukuid'];
    protected $table = 'bukus';

    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit'
    ];
}
