<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest; // <-- 1. Import Form Request yang baru dibuat
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    /**
     * Menampilkan halaman setup profil untuk pengguna baru.
     * Metode ini dibutuhkan oleh rute `profile.setup`.
     */
    public function setup(): View
    {
        return view('profile.setup');
    }

    /**
     * Menyimpan data profil dari halaman setup.
     * Metode ini dibutuhkan oleh rute `profile.store`.
     * Menggunakan Form Request yang sama dengan update untuk konsistensi.
     */
    public function store(UpdateProfileRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Ambil data yang sudah tervalidasi
        $validatedData = $request->validated();
        
        // Update data pengguna
        $user->update($validatedData);

        // Arahkan ke dasbor setelah profil berhasil dilengkapi
        return redirect()->route('dashboard')->with('success', 'Selamat datang! Profil Anda berhasil dilengkapi.');
    }

    /**
     * Menampilkan halaman untuk melihat/mengedit profil yang sudah ada.
     * Metode ini dibutuhkan oleh rute `profile.edit`.
     */
    public function edit(): View
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Memperbarui data profil dari halaman edit.
     * Metode ini dibutuhkan oleh rute `profile.update`.
     * Menggunakan Form Request untuk validasi yang bersih.
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        // Ambil data yang sudah tervalidasi
        $validatedData = $request->validated();
        
        // Update data pengguna
        $request->user()->update($validatedData);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
    
    /**
     * Menghapus akun pengguna.
     * Metode ini dibutuhkan oleh rute `profile.destroy`.
     * Ini adalah fitur krusial yang perlu ditangani dengan hati-hati.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Logout pengguna sebelum menghapus akun
        Auth::logout();

        if ($user->delete()) {
            // Invalidate session dan regenerate token untuk keamanan
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->with('success', 'Akun Anda telah berhasil dihapus.');
        }

        // Jika gagal menghapus, kembalikan ke dasbor
        return redirect()->route('dashboard')->with('error', 'Gagal menghapus akun. Silakan coba lagi.');
    }
}