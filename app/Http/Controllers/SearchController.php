<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    // Fungsi index untuk menangani permintaan pencarian dan menampilkan hasilnya
    public function index(Request $request)
    {
        // Mengambil input pencarian dari request
        $search = $request->input('search');
        
        // Mencari postingan yang sesuai dengan input pencarian
        $posts = Post::query()
            ->where('nama', 'LIKE', "%{$search}%")
            ->orWhere('ttl', 'LIKE', "%{$search}%")
            ->orWhere('sekolah', 'LIKE', "%{$search}%")
            ->orWhere('keterangan', 'LIKE', "%{$search}%")
            ->get();

        // Mengembalikan view 'home' dengan data postingan yang ditemukan
        return view('dashboard', compact('posts'));
    }
}