<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Carbon;
use App\Models\KoleksiPribadi;
use App\Models\UlasanBuku;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::selectRaw('distinct(transpinjam), created_at, userId')->where('statusPeminjaman', 1)->orderBy('created_at')->with('user')->paginate(10)->withQueryString();

        if ( request()->exists('keyPengembalian') ) {
            $keyPengembalian = request()->get('keyPengembalian');
            $peminjaman = Peminjaman::selectRaw('distinct(transpinjam), created_at, userId')->where('statusPeminjaman', 1)->orderBy('created_at');

            $peminjaman = $peminjaman->where(function ($query) use ($keyPengembalian) {
                $query->where('transpinjam', 'like', '%' . $keyPengembalian . '%');
            })->with('user')->paginate(10)->withQueryString();


        }

        return view("admin.Pengembalian.Pengembalian", [
            'peminjaman' => $peminjaman
        ]);
    }

    public function transPinjam ($keyPengembalian) {
        $peminjaman = Peminjaman::where('transpinjam', 'like', '%' . $keyPengembalian . '%')->where('statusPeminjaman', 1)->with('user')->first();

        $dataBuku = Peminjaman::where('transpinjam', 'like', '%' . $keyPengembalian . '%')->where('statusPeminjaman', 1)->with('buku')->get();


        return view("admin.Pengembalian.transPinjam", [
            'peminjaman' => $peminjaman,
            'bukus' => $dataBuku,
        ]);
    }

    public function store ($id) {
        $bukuDikembalikans = Peminjaman::where('transpinjam', 'like', '%' . $id . '%')->where('statusPeminjaman', 1)->with(['buku', 'user'])->get();
        $denda = 0;
        $i = 0;

        // Waktunya
        $sekarang = Carbon::now();
        $tglPinjam = Carbon::parse($bukuDikembalikans[0]->created_at);
        $tglKembali = $tglPinjam->copy()->addDays(5);;
        $selisih = $sekarang->diffInDays($tglKembali);

        if ( $tglKembali > $sekarang ) { $selisih = 0; }

        foreach($bukuDikembalikans as $bukuDikembalikan) {
            $denda += request('denda'. $i);
            $denda += 1000 * $selisih; 
            $i++;

            KoleksiPribadi::create([
                'koleksiId' => date('Ymd') . uniqid(),
                'userId' => $bukuDikembalikan->userId,
                'bukuId' => $bukuDikembalikan->bukuId,
            ]);

            // UlasanBuku::create([
            //     'ulasanId' => date('Ymd') . UlasanBuku::count(),
            //     'userId' => $bukuDikembalikan->userId,
            //     'bukuId' => $bukuDikembalikan->bukuId,
            // ]);
        }

        Pengembalian::create([
            'pengembalianId' => date('Ymd') . uniqid(),
            'transPinjam' => $bukuDikembalikans[0]->transpinjam,
            'userId' => $bukuDikembalikans[0]->userId,
            'denda' => $denda,
        ]);

        Peminjaman::where('transpinjam', 'like', '%' . $id . '%')->where('statusPeminjaman', 1)->update([
            'statusPeminjaman' => 0,
        ]);

        if ( auth()->user()->role == 2 ) {
            return redirect('/petugas/pengembalian');
        }

        return redirect('/pengembalian');
    }

}
