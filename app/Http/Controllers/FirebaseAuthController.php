<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FirebaseAuthController extends Controller
{
    public function login(Request $request)
    {
        $idToken = $request->input('idToken');

        if (!$idToken) {
            return response()->json(['status' => 'error', 'message' => 'Token tidak ditemukan.'], 400);
        }

        try {
            $path = storage_path('app/firebase-credentials.json');
            if (!file_exists($path)) {
                throw new \Exception("File firebase-credentials.json tidak ditemukan.");
            }

            $factory = (new Factory)->withServiceAccount($path);
            $auth    = $factory->createAuth();

            // Verifikasi Token Firebase
            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $claims          = $verifiedIdToken->claims();
            $email           = $claims->get('email');
            $name            = $claims->get('name');
            $firebaseUid     = $claims->get('sub');

            if (!$email) {
                throw new \Exception("Email tidak ditemukan dalam token Google.");
            }

            // --- CARI ATAU BUAT USER ---
            // Cari berdasarkan email atau firebase_uid untuk mencegah duplikat
            $user = User::where('email', $email)
                        ->orWhere('firebase_uid', $firebaseUid)
                        ->first();

            if (!$user) {
                $user = User::create([
                    'name'              => $name ?? 'User',
                    'email'             => $email,
                    'firebase_uid'      => $firebaseUid,
                    'password'          => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                    'username'          => Str::slug($name ?? 'user') . Str::random(4),
                ]);
            } else {
                // Sinkronkan firebase_uid jika user lama belum punya
                $user->updateQuietly(['firebase_uid' => $firebaseUid]);
            }

            // --- PROSES LOGIN (URUTAN KRITIS) ---

            // STEP 1: Regenerate session DULU (clean slate) sebelum menulis apapun
            // ini mencegah session fixation attack dan memberi session ID baru
            $request->session()->regenerate();

            // STEP 2: Login ke guard 'web' dengan remember=true
            // ini menulis user ID ke dalam session yang baru
            Auth::guard('web')->login($user, true);

            // STEP 3: Pastikan instance Auth global juga mengenali user ini
            Auth::setUser($user);

            // STEP 4: Tulis data tambahan dan paksa flush/save ke storage backend
            $request->session()->put('logged_in_at', now()->toDateTimeString());
            $request->session()->save();

            Log::info('Firebase Login Berhasil', [
                'user_id' => $user->id,
                'email'   => $user->email,
            ]);

            return response()->json([
                'status'   => 'success',
                'redirect' => route('beranda'),
                'message'  => 'LOGIN_SUCCESS',
            ]);

        } catch (\Exception $e) {
            Log::error('Firebase Login Error: ' . $e->getMessage());
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal Verifikasi: ' . $e->getMessage(),
            ], 401);
        }
    }
}