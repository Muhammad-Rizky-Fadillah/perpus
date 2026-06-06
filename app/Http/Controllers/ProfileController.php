<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman profile user.
     */
    public function show_profile()
    {
        $user = Auth::user();
        return view('show_profile', compact('user'));
    }

    /**
     * Mengupdate profile user.
     */
    public function edit_profile(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|max:50',
            'tahun_ajaran' => 'required|string|max:50',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        // Update data
        $user->name = $validated['name'];
        $user->nis = $validated['nis'];
        $user->tahun_ajaran = $validated['tahun_ajaran'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile berhasil diperbarui.');
    }
}
