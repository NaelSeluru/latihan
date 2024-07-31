<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // Menampilkan semua post
    public function index(Request $request)
    {
        // Mendapatkan user yang sedang login
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login'); // Redirect ke halaman login jika pengguna belum login
        }
        $query = Post::query();

        // Logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('ttl', 'LIKE', "%{$search}%")
                  ->orWhere('sekolah', 'LIKE', "%{$search}%")
                  ->orWhere('keterangan', 'LIKE', "%{$search}%");
            });
        }

        // Mengambil semua data yang sesuai dengan pencarian
        $allPosts = $query->get();
        // Data yang di-post oleh pengguna yang sedang login
        $userPosts = Post::where('user_id', $user->id)->get();
        // Data publik lainnya
        $publicPosts = $allPosts->where('user_id', '!=', $user->id);
        // Menghitung jumlah post pengguna
        $userPostCount = $userPosts->count();
        // Batas maksimal upload data per pengguna
        $maxUploads = 1;

        return view('dashboard', compact('userPosts', 'publicPosts', 'userPostCount', 'maxUploads'));
    }
 
    // Menampilkan form untuk membuat post baru
    public function create()
    {
        return view('posts.create');
    }

    // Menyimpan post baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'ttl' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        // Cek apakah user sudah memiliki data
        $existingPost = Post::where('user_id', auth()->id())->first();
        if ($existingPost) {
            return redirect()->back()->withErrors(['error' => 'Anda hanya bisa menambahkan satu data.']);
        }

        // Membuat post baru
        $post = new Post();
        $post->nama = $request->nama;
        $post->ttl = $request->ttl;
        $post->sekolah = $request->sekolah;
        $post->keterangan = $request->keterangan;
        $post->user_id = auth()->user()->id; 
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit post yang ada
    public function ubah($id)
    {
        // Mengambil data post berdasarkan ID
        $post = Post::find($id);
        return view('posts.ubah', compact('post'));
    }

    // Mengupdate post yang ada di database
    public function update(Request $request, Post $post)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'ttl' => 'required',
            'sekolah' => 'required',
            'keterangan' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')
                         ->with('success', 'Data Berhasil diubah.');
    }

    // Menghapus post dari database
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Data Berhasil dihapus.');
    }

    // Menampilkan semua post
    public function show()
    {
        // Mengambil semua data post
        $post = Post::all();
        return view('posts.show', compact('post'));
    }

}