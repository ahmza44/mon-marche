@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto mt-16 p-8 bg-white shadow-xl rounded-2xl text-center border border-gray-100">

    {{-- ICON --}}
    <div class="mb-4 text-4xl">
        @if(isset($alreadyVerified) && $alreadyVerified)
            ⚠️
        @else
            🎉
        @endif
    </div>

    {{-- TITLE --}}
    <h1 class="text-2xl font-bold mb-3 text-gray-800">
        Bonjour {{ $name }}
    </h1>

    {{-- MESSAGE --}}
    @if(isset($alreadyVerified) && $alreadyVerified)
        <p class="text-orange-600 font-semibold mb-4">
            Ce compte est déjà activé
        </p>
    @else
        <p class="text-green-600 font-semibold mb-4">
            Email vérifié avec succès
        </p>
    @endif

    {{-- EMAIL --}}
    <p class="text-gray-500 mb-6 text-sm">
        {{ $email }}
    </p>

    {{-- BUTTON --}}
    <a href="{{ route('login') }}"
       class="inline-block bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition font-semibold">
        Se connecter
    </a>

</div>

@endsection