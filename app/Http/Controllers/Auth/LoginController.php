<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // LOGIN
    public function login(Request $request)
    {
        // validation بسيطة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // نلقاو customer
        $customer = Customer::where('email', $request->email)->first();

        // check password
        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect'
            ]);
        }

        // login user
       
Auth::login($customer);
$request->session()->regenerate();
$request->session()->forget('url.intended');

if ($customer->role === 'admin') {
    return redirect()->route('dashboard');
}

return redirect()->route('customer.accueil');
        // redirect حسب role
       

       
    }

    // LOGOUT
    use Illuminate\Support\Facades\Auth;

public function logout(Request $request)
{
    Auth::guard('customer')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}