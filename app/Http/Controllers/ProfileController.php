<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

// Keterangan: Controller ini digunakan untuk mengatur profil pengguna, termasuk menampilkan form profil, memperbarui informasi profil, menghapus akun, dan mengunggah foto profil.

class ProfileController extends Controller
{
    //Menampilkan form profil pengguna.
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    //Memperbarui informasi profil pengguna.
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    //Menghapus akun pengguna.
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }

    //Mengunggah foto profil pengguna.
    public function uploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|mimes:jpeg,png,jpg|max:2048', // max 2MB
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $user->profile_picture = '/images/'.$name;
        }
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }
}