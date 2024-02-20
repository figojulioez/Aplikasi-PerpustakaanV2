<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class LaporanController extends Controller
{
    public function indexPeminjaman () {
        $peminjaman = Peminjaman::orderBy('created_at', 'DESC')->paginate(10)->withQueryString();

          if ( request()->exists('key') ) {
            $key = request()->get('key');
            $peminjaman = Peminjaman::orderBy('created_at', 'DESC')->orWhere('peminjamanId', 'like', '%'. $key . '%')->orWhere('transpinjam', 'like', '%'. $key . '%')->orWhere('bukuId', 'like', '%'. $key . '%')->orWhere('userId', 'like', '%'. $key . '%')->paginate(10)->withQueryString();
        }

        return view('laporan.LaporanPeminjaman', [
            'peminjamans' => $peminjaman
        ]);
    }

    public function createLaporanPeminjaman () {
        $peminjaman = Peminjaman::orderBy('created_at', 'DESC')->get();

          if ( request()->exists('key') ) {
            $key = request()->get('key');
            $peminjaman = Peminjaman::orderBy('created_at', 'DESC')->orWhere('peminjamanId', 'like', '%'. $key . '%')->orWhere('transpinjam', 'like', '%'. $key . '%')->orWhere('bukuId', 'like', '%'. $key . '%')->orWhere('userId', 'like', '%'. $key . '%')->get();
        }

         return view('laporan.LaporanPeminjamanS', [
            'peminjamans' => $peminjaman
        ]);
    }

    public function indexPengembalian () {
        $pengembalian = Pengembalian::join('peminjamans', 'peminjamans.transpinjam', '=', 'pengembalians.transPinjam')->selectRaw('distinct("peminjamans.transpinjam"), peminjamans.transpinjam, peminjamans.created_at as tglPinjam, pengembalians.created_at as tglKembali, pengembalians.denda, pengembalians.userId, pengembalians.pengembalianId')->orderBy('pengembalians.created_at', 'DESC')->paginate(10)->withQueryString();

          if ( request()->exists('key') ) {
            $key = request()->get('key');
            $pengembalian = Pengembalian::join('peminjamans', 'peminjamans.transpinjam', '=', 'pengembalians.transPinjam')->selectRaw('distinct("peminjamans.transpinjam"), peminjamans.transpinjam, peminjamans.created_at as tglPinjam, pengembalians.created_at as tglKembali, pengembalians.denda, pengembalians.userId, pengembalians.pengembalianId')->orWhere('peminjamans.transpinjam', 'like' , '%' . $key . '%')->orWhere('peminjamans.created_at', 'like' , '%' . $key . '%')->orWhere('pengembalians.created_at', 'like' , '%' . $key . '%')->orWhere('pengembalians.pengembalianId', 'like' , '%' . $key . '%')->orWhere('pengembalians.denda', 'like' , '%' . $key . '%')->orWhere('pengembalians.userId', 'like' , '%' . $key . '%')->paginate(10)->withQueryString();
        }



        return view('laporan.LaporanPengembalian', [
            'pengembalians' => $pengembalian
        ]);
    }

    public function createLaporanPengembalian () {
        $pengembalian = Pengembalian::join('peminjamans', 'peminjamans.transpinjam', '=', 'pengembalians.transPinjam')->selectRaw('distinct("peminjamans.transpinjam"), peminjamans.transpinjam, peminjamans.created_at as tglPinjam, pengembalians.created_at as tglKembali, pengembalians.denda, pengembalians.userId, pengembalians.pengembalianId')->orderBy('pengembalians.created_at', 'DESC')->get();

        if ( request()->exists('key') ) {
            $key = request()->get('key');
            $pengembalian = Pengembalian::join('peminjamans', 'peminjamans.transpinjam', '=', 'pengembalians.transPinjam')->selectRaw('distinct("peminjamans.transpinjam"), peminjamans.transpinjam, peminjamans.created_at as tglPinjam, pengembalians.created_at as tglKembali, pengembalians.denda, pengembalians.userId, pengembalians.pengembalianId')->orWhere('peminjamans.transpinjam', 'like' , '%' . $key . '%')->orWhere('peminjamans.created_at', 'like' , '%' . $key . '%')->orWhere('pengembalians.created_at', 'like' , '%' . $key . '%')->orWhere('pengembalians.pengembalianId', 'like' , '%' . $key . '%')->orWhere('pengembalians.denda', 'like' , '%' . $key . '%')->orWhere('pengembalians.userId', 'like' , '%' . $key . '%')->paginate(10)->withQueryString();
        }


        return view('laporan.LaporanPengembalianS', [
            'pengembalians' => $pengembalian
        ]);
    }

}
