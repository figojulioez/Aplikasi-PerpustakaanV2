<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class KoleksiPribadi extends Model
{
    use HasFactory;
    protected $guarded = ['kategoriId'];

    public function buku () {
        return $this->belongsTo(Buku::class, 'bukuId', 'bukuId');
    }


}
