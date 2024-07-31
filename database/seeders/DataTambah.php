<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataTambah extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Loop untuk memasukkan banyak data ke tabel 'users'
        for ($i = 0; $i < 6; $i++) {
            DB::table('users')->insert([
                'name' => 'User' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make(Str::random(8)), // Batasi pembuatan password menjadi 8 karakter acak
            ]);
        }

        // Loop untuk memasukkan banyak data ke tabel 'posts'
        for ($i = 0; $i < 6; $i++) {
            DB::table('posts')->insert([
                'nama' => 'Nama' . $i,
                'ttl' => '2000-01-0' . $i,
                'sekolah' => 'Sekolah' . $i,
                'keterangan' => 'Keterangan' . $i,
                'user_id' => $i + 1, // Asosiasikan post dengan user yang berbeda
            ]);
        }
    }
}