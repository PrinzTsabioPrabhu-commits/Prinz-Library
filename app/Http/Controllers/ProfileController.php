<?php

namespace App\Http\Controllers;

use App\Models\User; // Import model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('edit-profile');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = $request->file('profile_photo')->store('profiles', 'public');
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'PROFILE_SYNCED: Data berhasil diperbarui.');
    }
}
