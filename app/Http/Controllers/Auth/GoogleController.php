<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
public function callback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    $customer = Customer::where('email', $googleUser->email)->first();

    if (!$customer) {
        // 🔥 user جديد فقط
        $customer = Customer::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'google_id' => $googleUser->id,
            'avatar' => $googleUser->avatar,
            'password' => null,
            'email_verified_at' => now(),
        ]);
    } else {
        // 🔥 user موجود → ما نبدلو حتى حاجة من DB
        // غير نربطو google_id إذا كان ناقص
        if (!$customer->google_id) {
            $customer->google_id = $googleUser->id;
            $customer->save();
        }
    }

    Auth::guard('customer')->login($customer);

    return redirect()->route('customer.accueil');
}
}