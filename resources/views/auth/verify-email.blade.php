@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h1 class="text-xl font-bold text-orange-500">
        🛒 Mon Marché
    </h1>

    <p class="mt-3 text-gray-600">
        Veuillez vérifier votre email avant de continuer.
    </p>

    @if (session('status') == 'verification-link-sent')
        <p class="text-green-600 mt-2">
            ✔ Nouveau lien envoyé !
        </p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
        @csrf
        <button class="bg-orange-500 text-white px-4 py-2 rounded">
            Renvoyer email
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button class="text-red-500 underline">
            Déconnexion
        </button>
    </form>

</div>

@endsection