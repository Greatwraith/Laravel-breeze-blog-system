<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        
        // $request->user()->fill($request->validated()); // ini tidak menghandle avatar
        $validated = $request->validated(); // Get validated data, pakai ini untuk update termasuk avatar.

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Handle avatar upload
        if($request->hasFile('avatar')){ // Cek apakah ada file avatar yang diupload
            if(!empty($request->user()->avatar)){ // Hapus avatar lama jika ada
                Storage::disk('public')->delete($request->user()->avatar); // Hapus file lama dari storage
            }

            $path = $request->file('avatar')->store('image', 'public'); // Simpan file baru ke storage
            $validated['avatar'] = $path; // Simpan path file baru ke dalam data yang akan diupdate
        }

        $request->user()->update($validated); // Update user dengan data yang sudah divalidasi dan termasuk path avatar baru jika ada

        return Redirect::route('profile.edit')->with('status', 'profile-updated'); // Redirect back ke halaman edit profile dengan status sukses
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
