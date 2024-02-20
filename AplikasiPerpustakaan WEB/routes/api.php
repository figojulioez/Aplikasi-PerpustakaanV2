<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\ApiBuku;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
    'middleware' => 'api', 
    'prefix' => 'auth',
], function () {
    Route::post('/buat', [ApiAuth::class, 'buat']);
    Route::post('/masuk', [ApiAuth::class, 'masuk']);
    Route::post('/keluar', [ApiAuth::class, 'logout']);
    Route::post('/me', [ApiAuth::class, 'me']);
    Route::post('/ganti', [ApiAuth::class, 'ganti']);
});

Route::group([
    'middleware' => 'api', 
    'prefix' => 'buku',
], function () {
    Route::post('/all', [ApiBuku::class, 'all']);
    Route::post('/kategori/{kategori}', [ApiBuku::class, 'searchKategori']);
    Route::post('/kategori', [ApiBuku::class, 'kategori']);
    Route::post('/detail/{bukuId}', [ApiBuku::class, 'detail']);
    Route::get('img/{kode}', [ApiBuku::class, 'foto']);
    Route::post('scanned', [ApiBuku::class, 'scanned']);
    Route::post('cekStatus', [ApiBuku::class, 'cekStatus']);
    Route::post('koleksiPribadi', [ApiBuku::class, 'koleksiPribadi']);
    Route::post('beriUlasan', [ApiBuku::class, 'beriUlasan']);
    Route::post('cekSudahRating', [ApiBuku::class, 'cekSudahRating']);
    Route::post('fetchKomentar', [ApiBuku::class, 'fetchKomentar']);
    Route::post('fetchPengembalian', [ApiBuku::class, 'fetchPengembalian']);
    Route::post('totalDenda', [ApiBuku::class, 'totalDenda']);

});

Route::get('/error', function () {
    return response()->json(['message' => 'Authorisasi tidak ada'], 401);
})->name('error');

