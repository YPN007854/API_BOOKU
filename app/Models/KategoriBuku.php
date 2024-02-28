<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBuku extends Model
{
    use HasFactory;
    protected $primaryKey = 'kategoriid';
    protected $guarded = ['kategoriid'];
    protected $table = 'kategori_bukus';

    protected $fillable = [
        'bukuid',
        'nama_kategori',
    ];

    public function bukus(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'bukuid');
    }

    public function kategori_buku_relasis(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'kategori_bukuid');
    }

}
