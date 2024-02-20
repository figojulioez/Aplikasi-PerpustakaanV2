<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;   
use Illuminate\Support\Facades\Hash; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'userId' => date('Ymd') . User::count(),
            'username' => 'Admin Figo',
            'email' => 'figojulioez@gmail.com',
            'role' => 1,
            'namaLengkap' => 'Julioez Candita Haga Figo Latupeirissa',
            'alamat' => 'Alamanda Regency Blok C2 No 9',
            'password' => Hash::make('password'),
        ]);
    }
}
