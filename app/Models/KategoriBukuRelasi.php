<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriBukuRelasi extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'kategori_bukuid';
    protected $guarded = ['kategori_bukuid'];
    protected $table = 'kategori_buku_relasis';

    protected $fillable = [
        'bukuid',
        'kategoriid',
    ];

    public function bukus(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'bukuid');
    }
    public function kategori_bukus(): BelongsTo
    {
        return $this->belongsTo(KategoriBuku::class, 'kategoriid');
    }
}
