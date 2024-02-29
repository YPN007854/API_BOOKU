<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UlasanBuku extends Model
{
    use HasFactory;
    use HasFactory;
    protected $primaryKey = 'ulasanid';
    protected $guarded = ['ulasanid'];
    protected $table = 'ulasan_bukus';

    protected $fillable = [
        'userid',
        'bukuid',
        'ulasan',
        'rating'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function bukus(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'bukuid');
    }
}

