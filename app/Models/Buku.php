<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $primaryKey = 'bukuid';
    protected $guarded = ['bukuid'];
    protected $table = 'bukus';

    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit'
    ];

    public function koleksi(): HasMany
    {
        return $this->hasMany(KoleksiPribadi::class);
    }

    public function kategori(): HasMany
    {
        return $this->hasMany(KoleksiPribadi::class);
    }
}
