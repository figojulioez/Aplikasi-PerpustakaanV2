<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function buat () {
        $rules = [
            'username' => ['required', 'min:7',  'unique:App\Models\User,username'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'namaLengkap' => ['required', 'min:5',],
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
            'userId' => 'USR' . date('ymd') . uniqid(),
            'username' => request('username'),
            'email' => request('email'),
            'role' => 3,
            'namaLengkap' => request('namaLengkap'),
            'alamat' => request('alamat'),
            'password' => Hash::make(request('password')),
        ]);

        return redirect('./masuk');
    }

    public function masuk ()
    {

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:7'],
        ];

        $pesan = [
            'email.email' => 'Email tidak valid',
            'password.min' => 'Minimal di isi 7 huruf'
        ];

        $validator = Validator::make(request()->all(), $rules, $pesan);

        if ( $validator->fails() ) {
            return back()->withErrors($validator);
        }


        if ( Auth::attempt(['email' => request('email'), 'password' => request('password')]) ) {
            request()->session()->regenerate();

            if ( Auth::user()->role == 2 ) {
                return redirect()->intended('/petugas/dashboard');
            }

            return redirect()->intended('dashboard');


        }

        return back()->withErrors([
            'email' => 'Data tidak sesuai atau tidak ada',
        ])->onlyInput('email');        
    }
}
