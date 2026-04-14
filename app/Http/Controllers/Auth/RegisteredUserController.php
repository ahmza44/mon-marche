<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\marcheMail;
use App\Models\Customer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:customers,email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'phone' => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string'],
        'city' => ['nullable', 'string', 'max:100'],
    ]);

    $user = Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'address' => $request->address,
        'city' => $request->city,

        // 🔥 DEFAULT AVATAR IMPORTANT
        'avatar' => 'avatars/default.png',
    ]);
// autification pur laravel
        event(new Registered($user));
// autification email pour manueal        
    /* Mail::to($user->email)->send(new marcheMail($user));
        //Auth::login($user);*/
         return redirect()->route('login')
        ->with('success', 'Vérifiez votre email avant de vous connecter.');
    }
}