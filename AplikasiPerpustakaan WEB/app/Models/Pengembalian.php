<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Peminjaman;

class Pengembalian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user () {
        return $this->belongsTo(User::class, 'userId', 'userId');
    }

    public function peminjaman () {
        return $this->hasMany(Peminjaman::class, 'transpinjam', 'transPinjam');
    }

}
