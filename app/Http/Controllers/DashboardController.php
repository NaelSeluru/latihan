<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data post dari database
        $posts = Post::all();
        
        // Mengembalikan view 'dashboard' dengan data post
        return view('dashboard', compact('posts'));
    }

}