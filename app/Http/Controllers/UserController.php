<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function verifikasiIndex()
    {
        $users = User::where('is_verified', false)->get();
        return view('admin.verifikasi', compact('users'));
    }

    public function verifikasiStore($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = true;
        $user->save();

        return back()->with('success', 'User berhasil diverifikasi.');
    }
}
