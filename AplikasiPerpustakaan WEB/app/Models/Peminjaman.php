<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Buku;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    public function buku () {
        return $this->belongsTo(Buku::class, 'bukuId', 'bukuId');
    }

}
