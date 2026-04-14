@extends('layouts.app')

@section('content')

<style>
    .card-auth{
        background: #fff;
        border: 1px solid #f3f4f6;
        box-shadow: 0 20px 60px rgba(0,0,0,.08);
        border-radius: 24px;
    }

    .input{
        width: 100%;
        padding: 12px 14px;
        border-radius: 14px;
        border: 1.5px solid #e5e7eb;
        background: #fafafa;
        font-size: 14px;
        outline: none;
        transition: .2s;
    }

    .input:focus{
        border-color: #ff7a00;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255,122,0,.12);
    }

    .btn{
        width: 100%;
        padding: 12px;
        border-radius: 14px;
        background: linear-gradient(135deg,#ff7a00,#ff9a35);
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: .2s;
    }

    .btn:hover{
        transform: translateY(-1px);
        box-shadow: 0 10px 25px rgba(255,122,0,.25);
    }

    .title{
        font-size: 22px;
        font-weight: 800;
        color: #111827;
    }

    .subtitle{
        font-size: 13px;
        color: #6b7280;
    }
</style>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 via-white to-orange-100 px-4">

    <div class="w-full max-w-md card-auth p-8">

        {{-- TITLE --}}
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
    Mon <span class="text-orange-500">Marché</span>
</h1>>
            <p class="subtitle">Créer un nouveau compte</p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input class="input" type="text" name="name" placeholder="Nom" required>
            <input class="input" type="email" name="email" placeholder="Email" required>
            <input class="input" type="text" name="phone" placeholder="Téléphone">
            <input class="input" type="password" name="password" placeholder="Mot de passe" required>
            <input class="input" type="password" name="password_confirmation" placeholder="Confirmer" required>

            <button class="btn" type="submit">
                Créer compte
            </button>
        </form>

        {{-- LOGIN LINK --}}
        <p class="text-center text-sm mt-5 text-gray-500">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">
                Connexion
            </a>
        </p>

    </div>

</div>

@endsection