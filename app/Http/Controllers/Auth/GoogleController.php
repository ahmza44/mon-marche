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

    $customer = Customer::updateOrCreate(
        ['email' => $googleUser->email],
        [
            'name' => $googleUser->name,
            'google_id' => $googleUser->id,
            'avatar' => $googleUser->avatar,
            'password' => null, // مهم بزاف
        ]
    );

    Auth::guard('customer')->login($customer);

    return redirect()->route('customer.accueil');
}
}