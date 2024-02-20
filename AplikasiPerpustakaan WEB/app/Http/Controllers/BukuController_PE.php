<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;

class BukuController_PE extends Controller
{
    public function index () {

        $buku = Buku::paginate(10)->withQueryString();

        if ( request()->exists('key') ) {
            $key = request()->get('key');
            $buku = Buku::orWhere('bukuId', 'like', '%'. $key . '%')->orWhere('judul', 'like', '%'. $key . '%')->orWhere('penulis', 'like', '%'. $key . '%')->orWhere('tahunTerbit', 'like', '%'. $key . '%')->orWhereRelation('kategori', 'namaKategori', 'like', '%' . $key .'%')->paginate(20)->withQueryString();
        }

        $kategoris = KategoriBuku::paginate(10)->withQueryString();

        if ( request()->exists('searchKateg') ) {
            $kategori = request()->get('searchKateg');
            $kategoris = KategoriBuku::orWhere('namaKategori', 'like', '%' . $kategori . '%')->orWhere('kategoriId', 'like', '%' . $kategori . '%')->paginate(10)->withQueryString();

        }
        

        $check = Peminjaman::where('statusPeminjaman', 1)->where('userId', auth()->user()->userId)->count();
        
        return view('peminjam.Buku.PendataanBuku', [
            'bukus' => $buku,
            'kategoris' => $kategoris,
            'cek' => $check
        ]);
    }
    public function storePinjam ($bukuId) {
        Peminjaman::create([
            'peminjamanId' =>  date('Ymd') . uniqid(),
            'transPinjam' => date('Ymd') . auth()->user()->userId,
            'userId' => auth()->user()->userId,
            'bukuId' => $bukuId,
            'statusPeminjaman' => true,
        ]);

        return redirect('/dashboard');
    }

}
