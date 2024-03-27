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

    public function users()
    {
        return $this->belongsToMany(User::class, 'koleksi_pribadis', 'bukuid', 'userid')
                    ->withPivot('tanggal_peminjaman', 'tanggal_pengembalian')
                    ->withTimestamps();
    }

    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'cover',
        'status'
    ];

    public function koleksi_pribadis(): HasMany
    {
        return $this->hasMany(KoleksiPribadi::class);
    }

    public function peminjamans(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'peminjamanid');
    }

    public function kategori_bukus(): HasMany
    {
        return $this->hasMany(KategoriBuku::class);
    }

    public function ulasan_bukus(): BelongsTo
    {
        return $this->belongsTo(UlasanBuku::class, 'ulasanid');
    }
}
