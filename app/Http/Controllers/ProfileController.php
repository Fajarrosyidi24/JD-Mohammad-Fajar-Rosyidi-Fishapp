<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = $request->user()->load('detail'); // load relasi detail

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $user instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => $user,
            'detail' => $user->detail,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    $user->fill($request->validated());
    
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    $user->save();

    $detailData = $request->only(['phone', 'address', 'birth_date', 'gender']);

    // Folder user di public storage
    $userFolder = "users/{$user->id}";

    // Handle photo_profile
    if ($request->hasFile('photo_profile')) {
        $file = $request->file('photo_profile');

        // Hapus file lama jika ada
        if ($user->detail && $user->detail->photo_profile) {
            Storage::disk('public')->delete($user->detail->photo_profile);
        }

        // Simpan file baru
        $detailData['photo_profile'] = $file->store($userFolder, 'public');
    }

    // Handle photo_ktp
    if ($request->hasFile('photo_ktp')) {
        $file = $request->file('photo_ktp');

        // Hapus file lama jika ada
        if ($user->detail && $user->detail->photo_ktp) {
            Storage::disk('public')->delete($user->detail->photo_ktp);
        }

        // Simpan file baru
        $detailData['photo_ktp'] = $file->store($userFolder, 'public');
    }

    // Update atau create detail
    $user->detail()->updateOrCreate(
        ['user_id' => $user->id],
        $detailData
    );

    return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }
}
