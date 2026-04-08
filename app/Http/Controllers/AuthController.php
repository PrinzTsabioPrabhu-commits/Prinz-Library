<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // VERSI DARURAT: Simpan password tanpa Hash::make()
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password, // Teks biasa
        ]);

        Auth::login($user);

        return redirect()->route('beranda')->with('success', 'WELCOME: Akun berhasil dibuat.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil user berdasarkan email
        $user = \App\Models\User::where('email', $request->email)->first();

        // Cek manual: user ada DAN password cocok (Teks Biasa)
        if ($user && $user->password === $request->password) {
            // Login-kan user secara manual ke dalam sistem Laravel
            Auth::login($user);
            $request->session()->regenerate();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'redirect' => route('beranda')
                ], 200);
            }
            return redirect()->intended('beranda');
        }

        // Jika gagal
        return response()->json([
            'status' => 'error',
            'message' => 'SECURITY_ALERT: Identitas tidak ditemukan.'
        ], 401);
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
