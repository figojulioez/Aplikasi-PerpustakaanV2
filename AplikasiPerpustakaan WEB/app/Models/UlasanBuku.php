<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Buku;


class UlasanBuku extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function buku () {
        return $this->belongsTo(Buku::class, 'bukuId', 'bukuId');
    }

    public function user () {
        return $this->belongsTo(User::class, 'userId', 'userId');        
    }
}
