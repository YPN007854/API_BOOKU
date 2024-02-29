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
        'nama_kategori',
    ];

}
