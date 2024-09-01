<?php

namespace Modules\Ladmin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ladmin\Engine\UlidGenerator;

class Article extends Model
{
    use HasFactory, UlidGenerator; // Tambahkan UlidGenerator disetiap model atau table yang menggunakan column ULID supaya setaip create data otomatis menambahkan ULID tanpa perlu input manual

    protected $fillable = [ //Tambahkan setiap column yang ada pada migrasi kesini untuk mengizinkan column di tambah atau edit
        'ulid',
        'category_id',
        'name',
        'slug',
        'article',
        'img_url',
        'type',
        'state',
    ];


    public function category():BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id');
    }
}
