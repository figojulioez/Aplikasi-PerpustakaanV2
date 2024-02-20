<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ApiAuth extends Controller
{
    public function __construct () {
        $this->middleware('auth:sanctum', ['except' => ['masuk', 'buat']]);
    }

    public function buat () {
        $jumlah = User::where('role', 3)->count() + 1;

        $rules = [
            'username' => ['required', 'min:7',  'unique:App\Models\User,username'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'namaLengkap' => ['required', 'min:5',],
            'alamat' => ['required', 'min:20'],
            'password' => ['required', 'min:7'],
        ];

        $pesan = [
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Minimal di isi 7 huruf',
            'username.unique' => 'Maaf tapi Username ini sudah pernah digunakan',
            'email.required' => 'Email tidak boleh kosong', 
            'email.email' => 'Email tidak valid',
            'email.unique' => "Maaf tapi email ini sudah pernah digunakan",
            'namaLengkap.min' => 'Minimal di isi 5 huruf',
            'namaLengkap.required' => 'Nama Lengkap tidak boleh kosong',
            'alamat.min' => 'Minimal di isi 20 huruf',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'password.min' => 'Minimal di isi 7 huruf',
            'password.required' => 'Password tidak boleh kosong',

        ];

        $validator = Validator::make(request()->all(), $rules, $pesan);

        if ( $validator->fails() ) {
            return response()->json(['message' => $validator->messages()], 421);
        }

        User::create([
            'userId' => 'USR' . date('ymd') . uniqid(),
            'username' => request('username'),
            'email' => request('email'),
            'role' => 3,
            'namaLengkap' => request('namaLengkap'),
            'alamat' => request('alamat'),
            'password' => Hash::make(request('password')),
        ]);

        return response()->json(['message' => 'Akun berhasil di buat']);
    }

    public function ganti () {
        if ( request('password') != '' ) {
            $rules = [
                'username' => ['required', 'min:7'],
                'email' => ['required', 'email'],
                'namaLengkap' => ['required', 'min:5',],
                'alamat' => ['required', 'min:20'],
                'password' => ['min:7'],
                'konfirmasiPassword' => ['min:7', 'same:password'],

            ];

            $pesan = [
                'username.required' => 'Username tidak boleh kosong',
                'username.min' => 'Minimal di isi 7 huruf',
                'email.required' => 'Email tidak boleh kosong', 
                'email.email' => 'Email tidak valid',
                'namaLengkap.min' => 'Minimal di isi 5 huruf',
                'namaLengkap.required' => 'Nama Lengkap tidak boleh kosong',
                'alamat.min' => 'Minimal di isi 20 huruf',
                'alamat.required' => 'Alamat tidak boleh kosong',
                'password.min' => 'Minimal di isi 7 huruf',
                'konfirmasiPassword.min' => 'Minimal di isi 7 huruf',
                'konfirmasiPassword.same' => 'Password tidak sesuai'
            ];

            $validator = Validator::make(request()->all(), $rules, $pesan);

            if ( $validator->fails() ) {
                return response()->json(['message' => $validator->messages()], 421);
            }




            User::where('id', auth()->user()->id)->update([
                'userId' => 'USR' . date('ymd') . User::count(),
                'username' => request('username'),
                'email' => request('email'),
                'role' => 3,
                'namaLengkap' => request('namaLengkap'),
                'alamat' => request('alamat'),
                'password' => Hash::make(request('password')),
            ]);
        } else {
            $rules = [
                'username' => ['required', 'min:7'],
                'email' => ['required', 'email'],
                'namaLengkap' => ['required', 'min:5',],
                'alamat' => ['required', 'min:20'],

            ];

            $pesan = [
                'username.required' => 'Username tidak boleh kosong',
                'username.min' => 'Minimal di isi 7 huruf',
                'email.required' => 'Email tidak boleh kosong', 
                'email.email' => 'Email tidak valid',
                'namaLengkap.min' => 'Minimal di isi 5 huruf',
                'namaLengkap.required' => 'Nama Lengkap tidak boleh kosong',
                'alamat.min' => 'Minimal di isi 20 huruf',
                'alamat.required' => 'Alamat tidak boleh kosong',
            ];

            $validator = Validator::make(request()->all(), $rules, $pesan);

            if ( $validator->fails() ) {
                return response()->json(['message' => $validator->messages()], 421);
            }

            User::where('id', auth()->user()->id)->update([
                'userId' => 'USR' . date('ymd') . User::count(),
                'username' => request('username'),
                'email' => request('email'),
                'role' => 3,
                'namaLengkap' => request('namaLengkap'),
                'alamat' => request('alamat'),
            ]);
        }


        return response()->json(['message' => 'Akun berhasil di buat']);
    }

    public function masuk ()
    {

        $rules = [
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:7'],
        ];

        $pesan = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.min' => 'Minimal di isi 7 huruf',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $validator = Validator::make(request()->all(), $rules, $pesan);

        if ( $validator->fails() ) {
            return response()->json(['message' => $validator->messages()], 421);
        }

        if (!$token = Auth::attempt(['email' => request('email'), 'password' => request('password')]) ) {
            return response()->json(['message' => ['email' => 'Email atau password tidak cocok']], 421);
        }

        $user = Auth::user();
        $token = $user->createToken(request('email'))->plainTextToken;

        return $this->respondWithToken($token);
    }

    public function me() {
        return response()->json(['message' => auth()->user()]);
    }

    public function respondWithToken ($token) {
        return response()->json(['message' => $token, 'data' => auth()->user()]);
    }
    public function logout () {
        $user = Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Anda berhasil keluar']);
    }



}
