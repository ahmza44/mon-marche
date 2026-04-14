<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $customer = Customer::where('email', $request->email)->first();

    if (!$customer || !Hash::check($request->password, $customer->password)) {
        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect'
        ]);
    }

    // 🚨 check verification
    if (is_null($customer->email_verified_at)) {
        return back()->withErrors([
            'email' => 'Veuillez vérifier votre email avant de vous connecter.'
        ]);
    }

    Auth::guard('customer')->login($customer);
    $request->session()->regenerate();

    return redirect()->route('customer.accueil');
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}