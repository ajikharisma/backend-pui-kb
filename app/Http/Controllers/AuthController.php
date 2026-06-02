<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 🔥 LOGIN
    public function login(Request $request)
    {
        // ✅ VALIDASI INPUT
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 🔥 AMBIL DATA
        $credentials = $request->only('email', 'password');

        // 🔥 CEK LOGIN
        if (Auth::attempt($credentials)) {

            // 🔥 REGENERATE SESSION (PENTING SECURITY)
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        // ❌ JIKA GAGAL
        return back()->withErrors([
            'login' => 'Email atau password salah'
        ])->withInput();
    }

    public function apiLogin(Request $request)
    {
        $request->validate([

            'email' => 'required|email',

            'password' => 'required'

        ]);

        $credentials = $request->only(
            'email',
            'password'
        );

        if (!Auth::attempt($credentials)) {

            return response()->json([

                'success' => false,

                'message' => 'Email atau password salah'

            ], 401);

        }

        /** @var \App\Models\User $user */ // 👈 TAMBAHKAN BARIS KOMENTAR INI
        $user = Auth::user();

        // 🔥 LETAK SOLUSINYA: Buat variabel $token di sini sebelum dioper ke bawah!
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token'   => $token, // 👈 Sekarang variabel $token ini sudah terdefinisi dan tidak eror lagi!
            'user' => [
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'email' => $user->email,
                'role' => $user->role,
            ]
        ]);

    }

    // 🔥 LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}