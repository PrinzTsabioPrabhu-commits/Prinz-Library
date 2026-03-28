<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function showRegister() { return view('register'); }

    /**
     * Proses Register: Data username akan disimpan ke kolom 'name' 
     * atau disesuaikan agar tidak error.
     */
   public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users', // Pastikan unik
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Simpan ke kolom yang benar!
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username, // <-- Sekarang masuk ke kolom username!
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('beranda')->with('success', 'ACCOUNT_CREATED: Welcome to the Library.');
} 

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'redirect' => route('beranda')
                ]);
            }

            return redirect()->intended(route('beranda'))->with('success', 'ACCESS_GRANTED: Welcome back.');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'SECURITY_ALERT: Email atau password salah.'
            ], 401);
        }

        return back()->withErrors(['email' => 'SECURITY_ALERT: Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome')->with('info', 'SYSTEM_LOG: Session terminated.');
    }
}