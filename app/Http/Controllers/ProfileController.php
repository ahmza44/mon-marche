<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Psy\Command\Command;


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

    $user = Auth::guard('customer')->user();

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->hasFile('avatar')) {

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->avatar = $request->file('avatar')->store('avatars', 'public');
    }

    $user->save();

    // 🔥 IMPORTANT FIX
    Auth::guard('customer')->login($user->fresh(), true);

    return back()->with('success', 'Profil mis à jour avec succès');
}
/*public function verifyEmail(string $hash)
{
    $id = base64_decode($hash);

    $profile = Customer::findOrFail($id);

    if ($profile->email_verified_at) {
        return view('emails.emailVerifed',[
            'name' => $profile->name,
            'email' => $profile->email,
        ]);
    }

    $profile->email_verified_at = now();
    $profile->save();

    return view('emails.emailVerifed', [
        'name' => $profile->name,
        'email' => $profile->email,
    ]);
}*/




/*public function verifyEmail(Request $request, $id)
{
    if (! $request->hasValidSignature()) {
        abort(403, 'Invalid or expired link');
    }

    $user = Customer::findOrFail($id);

    $alreadyVerified = (bool) $user->email_verified_at;

    if (! $alreadyVerified) {
        $user->email_verified_at = now();
        $user->save();
    }

    return view('emails.emailVerifed', [
        'name' => $user->name,
        'email' => $user->email,
        'alreadyVerified' => $alreadyVerified,
    ]);
}*/

public function destroy(Request $request)
{
    $user = Auth::guard('customer')->user();

    Auth::guard('customer')->logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Account deleted successfully.');
}
}