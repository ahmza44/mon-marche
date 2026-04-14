@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-orange-50 via-white to-orange-100">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-orange-100 p-8">

        {{-- TITLE --}}
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-black">
                Mon <span class="text-orange-500">Marché</span>
            </h1>

            <p class="text-sm text-gray-500 mt-2">
                Mot de passe oublié
            </p>
        </div>

        {{-- INFO --}}
        <p class="text-sm text-gray-600 mb-6 leading-relaxed">
            Saisissez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </p>

        {{-- STATUS --}}
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 p-3 rounded-xl">
                {{ session('status') }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-semibold text-gray-700">Email</label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       autofocus
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none"
                       placeholder="email@example.com">

                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition shadow-lg">
                Envoyer le lien de réinitialisation
            </button>

        </form>

        {{-- BACK --}}
        <div class="text-center mt-5 text-sm text-gray-500">
            <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">
                Retour à la connexion
            </a>
        </div>

    </div>

</div>

@endsection