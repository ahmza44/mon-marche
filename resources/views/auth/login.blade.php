@extends('layouts.app')

@section('content')

<style>
    .input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1.5px solid #E5E7EB;
        background: #F9FAFB;
        font-size: 14px;
        transition: .2s;
    }

    .input:focus {
        border-color: #FF7A00;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255,122,0,.12);
        outline: none;
    }

    .btn {
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        background: #FF7A00;
        color: white;
        font-weight: 700;
        transition: .2s;
    }

    .btn:hover {
        background: #ff8a1f;
        transform: translateY(-1px);
    }

    .divider {
        display:flex;
        align-items:center;
        gap:10px;
        font-size:12px;
        color:#9CA3AF;
        font-weight:600;
    }

    .divider::before,
    .divider::after {
        content:"";
        flex:1;
        height:1px;
        background:#E5E7EB;
    }

    .google-btn {
        width: 100%;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        padding: 11px;
        border-radius: 12px;
        border: 1.5px solid #E5E7EB;
        background: #fff;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        transition: .2s;
    }

    .google-btn:hover {
        border-color: #FF7A00;
        color: #FF7A00;
        background: #FFF6F0;
    }
</style>

<div class="min-h-[90vh] flex items-center justify-center bg-gray-50 px-4">

    <div class="w-full max-w-md">

        {{-- TITLE --}}
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-gray-900">
                Mon <span class="text-orange-500">Marché</span>
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Connectez-vous à votre compte
            </p>
        </div>

        {{-- CARD --}}
        <div class="bg-white border rounded-2xl shadow-sm p-6">

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="mb-4 p-3 rounded-xl bg-green-100 text-green-700 text-sm font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if ($errors->any())
                <div class="mb-4 p-3 rounded-xl bg-red-100 text-red-700 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" name="email" class="input mt-1"
                        value="{{ old('email') }}" required>
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="text-sm font-semibold">Mot de passe</label>

                    <div class="relative mt-1">
                        <input id="password" type="password" name="password" class="input pr-10" required>

                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm">
                            👁
                        </button>
                    </div>
                </div>

                {{-- REMEMBER --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="accent-orange-500">
                    <span class="text-sm text-gray-500">Se souvenir de moi</span>
                </div>

                {{-- LOGIN --}}
                <button class="btn">
                    Se connecter
                </button>

                {{-- DIVIDER --}}
                <div class="divider my-4">ou</div>

                {{-- GOOGLE LOGIN --}}
                <a href="{{ route('google.redirect') }}" class="google-btn">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#EA4335"
                              d="M12 10.2v3.9h5.5c-.2 1.4-1.7 4-5.5 4a6.1 6.1 0 1 1 0-12c1.7 0 2.9.7 3.6 1.3l2.5-2.4C16.9 3.7 14.7 3 12 3a9 9 0 1 0 0 18c5.2 0 8.6-3.6 8.6-8.8 0-.6-.1-1-.2-1.4H12z"/>
                    </svg>

                    Continue with Google
                </a>

                {{-- FORGOT --}}
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}"
                       class="text-orange-500 text-sm font-semibold hover:underline">
                        Mot de passe oublié ?
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
function togglePassword() {
    let input = document.getElementById("password");
    input.type = input.type === "password" ? "text" : "password";
}
</script>

@endsection