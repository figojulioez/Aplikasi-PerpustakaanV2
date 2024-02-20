<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;

class BukuController_P extends Controller
{
    public function index () {

        $buku = Buku::orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ( request()->exists('key') ) {
            $key = request()->get('key');
            $buku = Buku::orderBy('created_at', 'desc')->orWhere('bukuId', 'like', '%'. $key . '%')->orWhere('judul', 'like', '%'. $key . '%')->orWhere('penulis', 'like', '%'. $key . '%')->orWhere('tahunTerbit', 'like', '%'. $key . '%')->orWhereRelation('kategori', 'namaKategori', 'like', '%' . $key .'%')->paginate(20)->withQueryString();
        }

        $kategoris = KategoriBuku::orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ( request()->exists('searchKateg') ) {
            $kategori = request()->get('searchKateg');
            $kategoris = KategoriBuku::orderBy('created_at', 'desc')->orWhere('namaKategori', 'like', '%' . $kategori . '%')->orWhere('kategoriId', 'like', '%' . $kategori . '%')->paginate(10)->withQueryString();

        }

        
        return view('petugas.Buku.PendataanBuku', [
            'bukus' => $buku,
            'kategoris' => $kategoris,
        ]);
    }
}
