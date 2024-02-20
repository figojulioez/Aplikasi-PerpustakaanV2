<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\BukuController_P;
use App\Http\Controllers\BukuController_PE;
use App\Http\Controllers\LaporanController;


use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/masuk');
});


Route::group([
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'buku' => Buku::count(),
            'pengguna' => User::count(),
            'peminjaman' => Peminjaman::where('statusPeminjaman', 1)->count(),
            'pengembalian' => Pengembalian::count(),
        ]);
    });

    Route::delete('/pendataan-buku/kategori/delete/{kategori}', [BukuController::class, 'kategoriDelete']);
    Route::post('/pendataan-buku/kategori/{kategori}', [BukuController::class, 'kategoriUpdate']);
    Route::get('/pendataan-buku/kategori/{kategori}/edit', [BukuController::class, 'kategoriEdit']);
    Route::get('/pendataan-buku/kategori', [BukuController::class, 'kategori']);
    Route::post('/pendataan-buku/kategori', [BukuController::class, 'kategoriCreate']);

    Route::resource('/pendataan-buku', BukuController::class);

    Route::resource('/pengguna', PenggunaController::class);
    
    Route::get('/laporan-peminjaman', [LaporanController::class, 'indexPeminjaman']);
    Route::get('/laporan-peminjaman/create', [LaporanController::class, 'createLaporanPeminjaman']);
    Route::get('/laporan-pengembalian', [LaporanController::class, 'indexPengembalian']);
    Route::get('/laporan-pengembalian/create', [LaporanController::class, 'createLaporanPengembalian']);

});



Route::group([
    'middleware' => 'auth'
], function () {
    

    Route::get('/logout', function() {
     Auth::logout();

     request()->session()->invalidate();

     request()->session()->regenerateToken();

     return redirect('/masuk');
 });

    Route::get('/pengembalian', [PengembalianController::class, 'index']);
    Route::get('/pengembalian/{transPinjam}', [PengembalianController::class, 'transPinjam']);
    Route::post('/pengembalian/{transPinjam}', [PengembalianController::class, 'store']);

    Route::get('/ulasan/{bukuId}', [BukuController::class, 'ulasan']);
});

Route::group([
    'middleware' => ['auth', 'petugas'],
    'prefix' => 'petugas'
], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'buku' => Buku::count(),
            'pengguna' => User::count(),
            'peminjaman' => Peminjaman::where('statusPeminjaman', 1)->count(),
            'pengembalian' => Pengembalian::count(),
        ]);
    });

    Route::get('/pengembalian', [PengembalianController::class, 'index']);
    Route::get('/pengembalian/{transPinjam}', [PengembalianController::class, 'transPinjam']);
    Route::post('/pengembalian/{transPinjam}', [PengembalianController::class, 'store']);

    Route::get('/ulasan/{bukuId}', [BukuController::class, 'ulasan']);
    Route::get('/pendataan-buku', [BukuController_P::class, 'index']);
    Route::get('/ulasan/{bukuId}', [BukuController::class, 'ulasan']);
    Route::get('/laporan-peminjaman', [LaporanController::class, 'indexPeminjaman']);
    Route::get('/laporan-peminjaman/create', [LaporanController::class, 'createLaporanPeminjaman']);
    Route::get('/laporan-pengembalian', [LaporanController::class, 'indexPengembalian']);
    Route::get('/laporan-pengembalian/create', [LaporanController::class, 'createLaporanPengembalian']);

});


Route::group([
    'middleware' => ['guest'],
], function () { 
    Route::get('/masuk', function () {
        return view('login');
    })->name("login");

    Route::get('/buat', function () {
        return view('registrasi');
    });

    Route::post('/buat',[AuthController::class, 'buat']);
    Route::post('/masuk', [AuthController::class, 'masuk']);
});

Route::group([
    'middleware' => ['auth', 'peminjam'],
    'prefix' => 'peminjam'
], function () {
    Route::get('/pendataan-buku', [BukuController_PE::class, 'index']);
    Route::get('/ulasan/{bukuId}', [BukuController::class, 'ulasan']);
    Route::get('/pinjam/{bukuId}', [BukuController_PE::class, 'storePinjam']);
});