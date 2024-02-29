<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Riwayat extends Model
{
    use HasFactory;
    protected $primaryKey = 'riwayatid';
    protected $guarded = ['riwayatid'];
    protected $table = 'riwayats';

    protected $fillable = [
        'peminjamanid',
    ];

    public function peminjamans(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjamanid');
    }
}
