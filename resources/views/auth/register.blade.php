@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 via-white to-orange-100 px-4">

    <div 
        x-data="{ show1: false, show2: false, loading: false }"
        class="w-full max-w-lg bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-orange-100 p-8 transition-all duration-500"
    >

        {{-- LOGO --}}
        <div class="text-center mb-8">
            <div class="mx-auto w-16 h-16 mb-4 rounded-2xl overflow-hidden shadow-md border border-orange-100">
                <img src="{{ asset('storage/logo/logo.png') }}"
                     class="w-full h-full object-contain">
            </div>

            <h2 class="text-3xl font-extrabold text-gray-900">
                Créer un compte ✨
            </h2>

            <p class="text-sm text-gray-500 mt-2">
                Inscription rapide et sécurisée
            </p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('register') }}"
              @submit="loading = true"
              class="space-y-5">
            @csrf

            {{-- NAME --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" required
                       value="{{ old('name') }}"
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition"
                       placeholder="Votre nom">
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required
                       value="{{ old('email') }}"
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition"
                       placeholder="email@example.com">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PHONE --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" name="phone"
                       value="{{ old('phone') }}"
                       class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                              focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition"
                       placeholder="+212...">
            </div>

            {{-- CITY + ADDRESS --}}
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" name="city"
                           value="{{ old('city') }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                                  focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition">
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" name="address"
                           value="{{ old('address') }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                                  focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition">
                </div>
            </div>

            {{-- PASSWORD --}}
            <div class="relative">
                <label class="text-sm font-medium text-gray-700">Mot de passe</label>

                <input :type="show1 ? 'text' : 'password'"
                       name="password"
                       required
                       class="w-full mt-1 px-4 py-3 pr-12 rounded-xl border border-gray-200
                              focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition"
                       placeholder="••••••••">

                <button type="button"
                        @click="show1 = !show1"
                        class="absolute right-3 top-[38px] text-gray-400 hover:text-orange-500 transition">
                    <span x-text="show1 ? '🙈' : '👁️'"></span>
                </button>
            </div>

            {{-- CONFIRM --}}
            <div class="relative">
                <label class="text-sm font-medium text-gray-700">Confirmer mot de passe</label>

                <input :type="show2 ? 'text' : 'password'"
                       name="password_confirmation"
                       required
                       class="w-full mt-1 px-4 py-3 pr-12 rounded-xl border border-gray-200
                              focus:border-orange-400 focus:ring-2 focus:ring-orange-200 outline-none transition"
                       placeholder="••••••••">

                <button type="button"
                        @click="show2 = !show2"
                        class="absolute right-3 top-[38px] text-gray-400 hover:text-orange-500 transition">
                    <span x-text="show2 ? '🙈' : '👁️'"></span>
                </button>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    :disabled="loading"
                    class="w-full bg-gradient-to-r from-orange-500 to-orange-600
                           hover:from-orange-600 hover:to-orange-700
                           text-white font-semibold py-3 rounded-xl transition
                           flex items-center justify-center gap-2 shadow-lg">

                <svg x-show="loading"
                     class="w-5 h-5 animate-spin"
                     fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"
                            class="opacity-25"/>
                    <path fill="currentColor"
                          d="M4 12a8 8 0 018-8v8H4z"
                          class="opacity-75"/>
                </svg>

                <span x-text="loading ? 'Création...' : 'Créer un compte'"></span>
            </button>

        </form>

        {{-- LOGIN --}}
        <div class="mt-6 text-center text-sm text-gray-500">
            Déjà un compte ?
            <a href="{{ route('login') }}"
               class="text-orange-500 font-semibold hover:underline">
                Se connecter
            </a>
        </div>

    </div>

</div>

@endsection