<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

   public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'avatar' => 'nullable|image|max:2048',
    ]);

    $user = $request->user();

    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];

    // upload avatar فقط إذا user رفع صورة
    if ($request->hasFile('avatar')) {
        $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    }

    $user->update($data);

    return back()->with('success', 'Profil mis à jour avec succès');
}

   public function destroy(Request $request)
{
    $user = $request->user();

    // logout first
    Auth::logout();

    // delete account from DB
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}