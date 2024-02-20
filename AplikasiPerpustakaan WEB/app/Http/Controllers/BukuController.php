<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\UlasanBuku;
use App\Models\KategoriBuku;
use App\Models\Peminjaman;
use App\Models\KoleksiPribadi;
use App\Models\Pengembalian;

use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $buku = Buku::orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ( request()->exists('key') ) {
            $key = request()->get('key');
            $buku = Buku::orderBy('created_at', 'desc')->orWhere('bukuId', 'like', '%'. $key . '%')->orWhere('judul', 'like', '%'. $key . '%')->orWhere('penulis', 'like', '%'. $key . '%')->orWhere('tahunTerbit', 'like', '%'. $key . '%')->orWhereRelation('kategori', 'namaKategori', 'like', '%' . $key .'%')->paginate(20)->withQueryString();
        }

        $kategoris = KategoriBuku::orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        if ( request()->exists('searchKateg') ) {
            $kategori = request()->get('searchKateg');
            $kategoris = KategoriBuku::orderBy('created_at')->orWhere('namaKategori', 'like', '%' . $kategori . '%')->orWhere('kategoriId', 'like', '%' . $kategori . '%')->paginate(10)->withQueryString();

        }


        return view("admin.Buku.PendataanBuku", [
            'bukus' => $buku,
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("admin.buku.PendataanBukuCreate", [
            'kategoris' => KategoriBuku::all(), 
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules = [
            'judul' => ['required', 'max:30'],
            'penulis' => ['required', 'string'],
            'tahunTerbit' => ['required'],
            'kategoriId' => ['required'],
            'foto' => ['required', 'image'],
            'harga' => ['required', 'integer']
        ];

        $pesan = [
            'foto.image' => 'Wajib sebuah foto',
            'judul.max' => 'Huruf maksimal 30 huruf'
        ];


        $validator = Validator::make($request->all(), $rules, $pesan);

        if ( $validator->fails() ) {
            return back()->withErrors($validator);
        }

        

        // for($i = 0; $i < 100; $i++) {
        $foto = request()->file('foto')->store('img');
        Buku::create([
            'judul' => request('judul'),
            'penulis' => request('penulis'),
            'tahunTerbit' => intval(request('tahunTerbit')),
            'kategoryId' => request('kategoriId'),
            'foto' => $foto,
            'bukuId' => 'BU' . date('ymd') . uniqid(),
            'harga' => request('harga')
        ]);
        // }

        return redirect('./pendataan-buku');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $buku = Buku::where('bukuId', $id)->with('kategori')->first();

         return view("admin.buku.PendataanBukuEdit", [
            'kategoris' => KategoriBuku::all(), 
            'buku' => $buku,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        if ( request()->exists('foto') ) {
            $buku = Buku::select('foto')->where('bukuId', $id)->first()['foto'];

            Storage::delete($buku);

            $foto = request()->file('foto')->store('img');

            Buku::where('bukuId', $id)->update(['foto' => $foto]);
        }

        Buku::where('bukuId', $id)->update([
            'kategoryId' => request('kategoriId'),
            'judul' => request('judul'),
            'penulis' => request('penulis'),
            'tahunTerbit' => request('tahunTerbit'), 
        ]);

        return redirect('/pendataan-buku');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::select('foto')->where('bukuId', $id)->first()['foto'];
        Storage::delete($buku);
                
        Buku::where('bukuId', $id)->delete();

        UlasanBuku::where('bukuId', $id)->delete();
        KoleksiPribadi::where('bukuId', $id)->delete();

        $peminjaman = Peminjaman::selectRaw('distinct(transpinjam)')->where('bukuId', $id)->get();

        foreach($peminjaman as $pinjam) {
            Pengembalian::where('transPinjam', $pinjam->transpinjam)->delete();
        }


        return back();

    }
    public function kategori() {
        return view('admin.Buku.kategori');
    }
    public function kategoriCreate() {
        $rules = [
            'kategori' => ['required']
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ( $validator->fails() ) {
            return back()->withErrors($validator);
        }

        KategoriBuku::create([
            'namaKategori' => request('kategori'),
            'kategoriId' => 'KTG' . date('ymd') . uniqid(), 
        ]);

        return redirect('/pendataan-buku');

    }

    public function kategoriEdit ($kategori) {
        $kategoris = KategoriBuku::where('kategoriId', $kategori)->first();

        return view('admin.Buku.kategoriEdit', ['kategoris' => $kategoris]);
    }

    public function kategoriUpdate ($id) {
        $rules = [
            'kategori' => ['required']
        ];

        $validator = Validator::make(request()->all(), $rules);

        if ( $validator->fails() ) {
            return back()->withErrors($validator);
        }

        KategoriBuku::where('kategoriId', $id)->update([
            'namaKategori' => request('kategori'),
        ]);

        return redirect('/pendataan-buku');

    }

    public function kategoriDelete($id) {

        if ( Buku::where('kategoryId', $id)->count() > 0 ) {
            session()->flash('error', 'Data kategori masih digunakan, Harap hapus data buku terlebih dahulu');
            return back();
        }


        KategoriBuku::where('kategoriId', $id)->delete();

        return redirect('/pendataan-buku');
    }

    public function ulasan ($bukuId) {
        $buku = Buku::where('bukuId', $bukuId)->with('kategori')->first();
        $ulasan = UlasanBuku::where('bukuId', $bukuId)->with('user')->get();
        $rating = UlasanBuku::selectRaw('avg(rating) as rating')->where('bukuId', $bukuId)->first()->rating;

        return view('admin.Buku.UlasanBuku', [
            'buku' => $buku,
            'rating' => intval(ceil($rating)),
            'ulasan' => $ulasan
        ]); 
    }

}
