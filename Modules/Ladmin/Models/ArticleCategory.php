<?php

namespace Modules\Ladmin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ladmin\Engine\UlidGenerator;

class ArticleCategory extends Model
{
    use HasFactory, UlidGenerator; // Tambahkan UlidGenerator disetiap model atau table yang menggunakan column ULID supaya setaip create data otomatis menambahkan ULID tanpa perlu input manual

    protected $fillable = [ //Tambahkan setiap column yang ada pada migrasi kesini untuk mengizinkan column di tambah atau edit
        'ulid',
        'name',
        'type',
        'state',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
