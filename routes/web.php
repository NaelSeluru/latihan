<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;

// Middleware untuk mengarahkan pengguna ke halaman login jika belum login
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

Route::put('{id}/ubah', [PostController::class, 'ubah'])->name('posts.ubah');
Route::get('{id}/ubah', [PostController::class, 'ubah'])->name('posts.ubah');

Route::get('/form-tambah', function () {
    return view('/posts/form-tambah', [
        'title' => 'Form Tambah',
    ]);
});

Route::get('/layouts/guest', function () {
    return view('/layouts/guest');
});

// Rute CRUD untuk PostController
Route::resource('posts', PostController::class);

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'uploadPicture'])->name('profile.upload-picture');
});

require __DIR__.'/auth.php';