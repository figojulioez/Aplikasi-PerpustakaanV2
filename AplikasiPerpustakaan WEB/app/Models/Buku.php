<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\KategoriBuku;
class Buku extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kategori () {
        return $this->belongsTo(KategoriBuku::class, 'kategoryId', 'kategoriId');
    }
}
