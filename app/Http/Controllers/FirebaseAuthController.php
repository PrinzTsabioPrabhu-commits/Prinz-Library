<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FirebaseAuthController extends Controller
{
   public function login(Request $request)
{
    $idToken = $request->input('idToken');

    try {
        // OPTIMASI: Gunakan cache atau singleton jika memungkinkan, 
        // tapi untuk sekarang pastikan path file JSON sudah benar dan cepat dibaca.
        $factory = (new Factory)->withServiceAccount(storage_path('app/firebase-credentials.json'));
        $auth = $factory->createAuth();

        // Verifikasi token (Proses ini butuh koneksi internet ke Google)
        $verifiedIdToken = $auth->verifyIdToken($idToken);
        $uid = $verifiedIdToken->claims()->get('sub');
        
        // OPTIMASI: Gunakan data dari token saja jika sudah cukup, 
        // tidak perlu panggil $auth->getUser($uid) lagi kalau cuma butuh email.
        $email = $verifiedIdToken->claims()->get('email');
        $name = $verifiedIdToken->claims()->get('name');

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name ?? 'User',
                'password' => Hash::make(Str::random(24))
            ]
        );

        // SYNC: Jika nama di DB masih 'User' tapi dari Google ada nama asli, update DB.
        if ($name && ($user->name === 'User' || empty($user->name))) {
            $user->update(['name' => $name]);
        }

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'redirect' => route('beranda')
        ]);

    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 401);
    }
}
}