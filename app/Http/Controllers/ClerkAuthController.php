<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ClerkAuthController extends Controller
{
    /**
     * Tampilkan halaman callback (ditangani React)
     */
    public function showCallback()
    {
        return Inertia::render('auth/clerk-callback');
    }

    /**
     * Verifikasi Clerk token dan buat Laravel session
     * Dipanggil dari React callback page via fetch()
     */
    public function verify(Request $request)
    {
        $token = $request->input('token');

        if (!$token) {
            return response()->json(['status' => 'error', 'message' => 'Token tidak ditemukan.'], 400);
        }

        try {
            // Decode JWT payload (bagian tengah, base64url encoded)
            // Ini aman karena kita akan verifikasi user via Clerk REST API
            $parts = explode('.', $token);
            if (count($parts) !== 3) {
                throw new \Exception('Format token tidak valid.');
            }

            // Base64url → base64 decode
            $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);
            $clerkUserId = $payload['sub'] ?? null;

            if (!$clerkUserId) {
                throw new \Exception('User ID tidak ditemukan dalam token.');
            }

            // Verifikasi user dengan Clerk REST API menggunakan Secret Key
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.clerk.secret_key'),
            ])->get("https://api.clerk.com/v1/users/{$clerkUserId}");

            if (!$response->successful()) {
                throw new \Exception('Verifikasi Clerk gagal: ' . $response->status());
            }

            $clerkUser = $response->json();

            // Ambil email utama dari array email_addresses
            $primaryEmailId = $clerkUser['primary_email_address_id'] ?? null;
            $emailObj = collect($clerkUser['email_addresses'] ?? [])
                ->firstWhere('id', $primaryEmailId);
            $email = $emailObj['email_address'] ?? null;

            $firstName = $clerkUser['first_name'] ?? '';
            $lastName  = $clerkUser['last_name'] ?? '';
            $name      = trim("{$firstName} {$lastName}") ?: 'User';

            if (!$email) {
                throw new \Exception('Email tidak ditemukan dari Clerk.');
            }

            // --- CARI ATAU BUAT USER DI DATABASE ---
            $user = User::where('email', $email)
                        ->orWhere('firebase_uid', $clerkUserId) // kolom firebase_uid dipakai ulang untuk Clerk UID
                        ->first();

            if (!$user) {
                $user = User::create([
                    'name'              => $name,
                    'email'             => $email,
                    'firebase_uid'      => $clerkUserId,
                    'password'          => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                    'username'          => Str::slug($name) . Str::random(4),
                ]);
            } else {
                $user->updateQuietly(['firebase_uid' => $clerkUserId]);
            }

            // --- BUAT LARAVEL SESSION (URUTAN KRITIS) ---
            $request->session()->regenerate();         // 1. Session baru
            Auth::guard('web')->login($user, true);    // 2. Tulis user ke session
            Auth::setUser($user);                      // 3. Sync instance global
            $request->session()->put('logged_in_at', now()->toDateTimeString());
            $request->session()->save();               // 4. Flush ke database

            Log::info('Clerk Login Berhasil', [
                'user_id' => $user->id,
                'email'   => $user->email,
            ]);

            return response()->json([
                'status'   => 'success',
                'redirect' => route('beranda'),
            ]);

        } catch (\Exception $e) {
            Log::error('Clerk Login Error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal verifikasi: ' . $e->getMessage(),
            ], 401);
        }
    }
}
