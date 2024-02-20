<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugass = User::where('role', '!=', 1)->where('role', '!=', 3)->orderBy('created_at', 'desc');
        if ( request()->exists('petugas') ) {
            $petugas = request()->get('petugas');
            $petugass = $petugass->where(function ($query) use ($petugas) {
            $query->where('userId', 'like', '%' . $petugas . '%')
                ->orWhere('email', 'like', '%' . $petugas . '%')
                ->orWhere('namaLengkap', 'like', '%' . $petugas . '%')
                ->orWhere('alamat', 'like', '%' . $petugas . '%');
        });
        }

        $peminjams = User::where('role', '!=', 1)->where('role', '!=', 2)->orderBy('created_at', 'desc');
        if ( request()->exists('peminjam') ) {
            $peminjam = request()->get('peminjam');
            $peminjams = $peminjams->where(function ($query) use ($peminjam) {
            $query->where('userId', 'like', '%' . $peminjam . '%')
                ->orWhere('email', 'like', '%' . $peminjam . '%')
                ->orWhere('namaLengkap', 'like', '%' . $peminjam . '%')
                ->orWhere('alamat', 'like', '%' . $peminjam . '%');
        });
        }


        return view('admin.Pengguna.DataPengguna', [
            'petugass' => $petugass->paginate(10)->withQueryString(),
            'peminjams' => $peminjams->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Pengguna.PenggunaCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'username' => ['required', 'min:7',  'unique:App\Models\User,username'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'namaLengkap' => ['required', 'min:5'],
            'alamat' => ['required', 'min:20'],
            'password' => ['required', 'min:7'],
        ];

        $pesan = [
            'username.min' => 'Minimal di isi 7 huruf',
            'username.unique' => 'Maaf tapi Username ini sudah pernah digunakan', 
            'email.email' => 'Email tidak valid',
            'email.unique' => "Maaf tapi email ini sudah pernah digunakan",
            'namaLengkap.min' => 'Minimal di isi 5 huruf',
            'alamat.min' => 'Minimal di isi 20 huruf',
            'password.min' => 'Minimal di isi 7 huruf'

        ];

        $validator = Validator::make(request()->all(), $rules, $pesan);

        if ( $validator->fails() ) {
            return back()->withErrors($validator);
        }

        User::create([
            'userId' => 'PTGS' . date('ymd') . uniqid(),
            'username' => request('username'),
            'email' => request('email'),
            'role' => 2,
            'namaLengkap' => request('namaLengkap'),
            'alamat' => request('alamat'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect('./pengguna');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('userId', $id)->delete();

        return back();
    }
}
