<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Peminjaman;
use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;
use App\Models\Pengembalian;


class ApiBuku extends Controller
{
    public function __construct () {
        $this->middleware(['auth:sanctum'], ['except' => ['foto']]);        
    }

    public function all() {
        return response()->json(['message' => Buku::all()]);
    }

    public function searchKategori ($kategori) {


        $buku = Buku::whereHas('kategori', function ($query) use ($kategori) {
            $query->where('namaKategori', $kategori);
        });

        if ( request('buku')  == '') {
            return response()->json(['message' => $buku->get()]);
        } else if (request('buku') !== '' ) {
            $key = request('buku');
            $buku = $buku->where(function ($query) use ($key) {
                $query->orWhere('judul', 'like', '%'. $key . '%')->orWhere('tahunTerbit', 'like', '%'. $key . '%')->orWhere('penulis', 'like', '%'. $key . '%');
            });
            return response()->json(['message' => $buku->get()]);
        }
    }

    public function kategori () {
        return response()->json(['message'=> KategoriBuku::all()]);
    }

    public function detail ($bukuId) {
        $buku = Buku::where('bukuId', $bukuId)->with(['kategori'])->first();
        $rating = UlasanBuku::selectRaw('avg(rating) as rating')->where('bukuId', $bukuId)->first();

        $data = [
            'bukuId' => $buku->bukuId,
            'kategori' => $buku->kategori,
            'foto' => $buku->foto,
            'judul' => $buku->judul,
            'penulis' => $buku->penulis,
            'tahunTerbit' => $buku->tahunTerbit,
            'harga' => $buku->harga,
            'rating' => intval(ceil($rating->rating))
        ];

        return response()->json(['message' => $data]);
    }

    public function foto ($kode) {
        return response()->file(storage_path('app/public/img/'.$kode));
    }

    public function scanned () {
        $rules = [
            'dataBukus' => ['array:bukuId'],
        ];

        $validator = Validator::make(request('dataBukus'), $rules);

        if ( $validator->fails() ) {
            return response()->json(['message' => $validator->messages()], 421);
        }

        $dataBukus = request('dataBukus');

        if ( Peminjaman::where('transPinjam', date('Ymd') . auth()->user()->userId)->count() > 0 ) {
            return response()->json(['message' => 'Anda hanya bisa melakukan 1 kali transaksi dalam 1 hari'], 422);
        }

        foreach($dataBukus as $dataBuku) {
            Peminjaman::create([
                'peminjamanId' => date('Ymd') . uniqid(),
                'transPinjam' => date('Ymd') . auth()->user()->userId,
                'userId' => auth()->user()->userId,
                'bukuId' => $dataBuku['bukuId'],
                'statusPeminjaman' => true,
            ]);
        }
        
        return response()->json(['message' => 'Data berhasil dibuat']); 

    }

    public function cekStatus () {
        $check = Peminjaman::where('statusPeminjaman', 1)->where('userId', auth()->user()->userId)->count();
        $data = Peminjaman::where('statusPeminjaman', 1)->where('userId', auth()->user()->userId)->with('buku')->get();

        if ( $check > 0 ) {
            return response()->json(['message' => true, 'data' => $data]);
        }
        
        return response()->json(['message' => false]);
    }


    public function KoleksiPribadi () {
        $koleksi = KoleksiPribadi::selectRaw('distinct(bukuId), userId, bukuId')->where('userId', auth()->user()->userId)->with('buku')->get();
        return response()->json(['message' => $koleksi]);   
    }

    public function beriUlasan () {

        $rule = [
            'bukuId' => ['required'],
            'rating' => ['required'],
            'ulasan' => ['required']
        ];

        $pesan = [
            'ulasan.required' => 'Ulasan tidak boleh kosong'
        ];

        $validator = Validator::make(request(['bukuId', 'rating', 'ulasan']), $rule, $pesan);

        if ( $validator->fails() ) {
            return response()->json(['messages' => $validator->messages()], 422);                
        }

        UlasanBuku::create([
            'ulasanId' => date('Ymd') . uniqid(),
            'userId' => auth()->user()->userId,
            'bukuId' => request('bukuId'),
            'rating' => request('rating'),
            'ulasan' => request('ulasan')
        ]);

        return response()->json(['message' => 'Data berhasil dibuat']);
    }

    public function cekSudahRating () {
        $cek = UlasanBuku::where('bukuId', request('bukuId'))->where('userId', auth()->user()->userId)->where('ulasan', '!=', '')->count();

        if ( $cek > 0 ) {
            return response()->json(['message' => true]);
        }
        return response()->json(['message' => false]);
    }

    public function fetchKomentar () {
        $data = UlasanBuku::where('bukuId', request('bukuId'))->orderBy('created_at', 'desc')->with('user')->get();
        return response()->json(['message' => $data]);
    }

    public function fetchPengembalian () {
        $pengembalians = Pengembalian::where('userId', auth()->user()->userId)->with('peminjaman')->get();
        $data = [];
        $judulnya = '';

        foreach ($pengembalians as $pengembalian) {
            $peminjamans = Peminjaman::selectRaw('transPinjam, bukuId, created_at')->where('userId', auth()->user()->userId)->where('transpinjam', $pengembalian->transPinjam)->with('buku')->get();

            foreach($peminjamans as $peminjaman) {
                $judulnya .= $peminjaman->buku->judul . ', ';    
            }

            $data[] = [
                'judul' => $judulnya,
                'denda' => $pengembalian->denda,
                'created_at' => $pengembalian->created_at,
            ];           

            $judulnya = '';

        }
        return response()->json($data);
    }

    public function totalDenda () {
        $totalDenda = Pengembalian::selectRaw('sum(denda) as total')->where('userId', auth()->user()->userId)->first();
        
        return response()->json(['message' => $totalDenda->total]);
    }    
}
