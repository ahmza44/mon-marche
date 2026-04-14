@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-orange-50 via-white to-orange-100">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-orange-100 p-8">

        {{-- TITLE --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-black">
                Mon <span class="text-orange-500">Marché</span>
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Réinitialiser votre mot de passe
            </p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-semibold text-gray-700">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $request->email) }}"
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none"
                       required>
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="text-sm font-semibold text-gray-700">Nouveau mot de passe</label>
                <input type="password"
                       name="password"
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none"
                       required>
            </div>

            {{-- CONFIRM --}}
            <div>
                <label class="text-sm font-semibold text-gray-700">Confirmer mot de passe</label>
                <input type="password"
                       name="password_confirmation"
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none"
                       required>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition shadow-lg">
                Réinitialiser
            </button>

        </form>

    </div>

</div>

@endsection