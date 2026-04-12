@extends('layouts.app')

@section('content')

<style>
    @keyframes fadeUp {
        from { opacity:0; transform:translateY(20px); }
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes floatA {
        0%,100% { transform:translateY(0) scale(1); }
        50%      { transform:translateY(-20px) scale(1.04); }
    }
    @keyframes floatB {
        0%,100% { transform:translateY(0) scale(1); }
        50%      { transform:translateY(16px) scale(0.97); }
    }

    .card-anim  { animation: fadeUp .65s cubic-bezier(.22,1,.36,1) both; }
    .blob-a     { animation: floatA 8s ease-in-out infinite; }
    .blob-b     { animation: floatB 10s ease-in-out infinite; }

    .field-base {
        width: 100%;
        padding: 12px 16px 12px 42px;
        border-radius: 12px;
        border: 1.5px solid #E5E7EB;
        background: #F9FAFB;
        font-family: 'Figtree', sans-serif;
        font-size: 14px;
        color: #111827;
        outline: none;
        transition: border-color .2s, background .2s, box-shadow .2s;
    }
    .field-base::placeholder { color: #9CA3AF; }
    .field-base:focus {
        border-color: #FF7A00;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255,122,0,.11);
    }

    .btn-submit {
        width: 100%;
        padding: 13px;
        border-radius: 12px;
        font-size: 14.5px;
        font-weight: 700;
        color: #fff;
        border: none;
        cursor: pointer;
        background: linear-gradient(135deg, #FF7A00 0%, #FF9A35 100%);
        box-shadow: 0 6px 22px rgba(255,122,0,.32);
        transition: box-shadow .2s, transform .15s, filter .2s;
    }
    .btn-submit:hover {
        box-shadow: 0 8px 28px rgba(255,122,0,.44);
        transform: translateY(-1px);
        filter: brightness(1.05);
    }
    .btn-submit:active { transform: translateY(0); }

    .divider {
        display:flex; align-items:center; gap:12px;
        color:#D1D5DB; font-size:12px; font-weight:600;
    }
    .divider::before,.divider::after {
        content:''; flex:1; height:1px; background:#E5E7EB;
    }

    .google-btn {
        width: 100%;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
        padding: 12px;
        border-radius: 12px;
        border: 1.5px solid #E5E7EB;
        background: #fff;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        transition: all .2s;
    }
    .google-btn:hover {
        background: #F9FAFB;
        border-color: #FF7A00;
        color: #FF7A00;
    }
</style>

<div class="relative min-h-[90vh] flex items-center justify-center px-4 py-12 overflow-hidden"
     style="background:linear-gradient(135deg,#fff8f2 0%,#ffffff 50%,#fff4ea 100%);">

    <div class="blob-a absolute w-[480px] h-[480px] rounded-full"
         style="background:radial-gradient(circle,rgba(255,122,0,.09) 0%,transparent 70%);
                top:-160px;left:-140px;"></div>

    <div class="blob-b absolute w-[380px] h-[380px] rounded-full"
         style="background:radial-gradient(circle,rgba(255,154,53,.07) 0%,transparent 70%);
                bottom:-120px;right:-100px;"></div>

    <div class="card-anim w-full max-w-md relative">

        <div class="bg-white rounded-3xl border border-gray-100 p-8
                    shadow-[0_24px_60px_rgba(0,0,0,.08)]">

            {{-- HEADER --}}
            <div class="text-center mb-8">
                <div class="mx-auto mb-4 w-14 h-14 rounded-2xl overflow-hidden flex items-center justify-center"
                     style="background:linear-gradient(135deg,#FF7A00,#FF9A35);">
                    <img src="{{ asset('storage/logo/logo.png') }}" class="w-full h-full object-contain">
                </div>

                <h2 class="text-2xl font-extrabold text-gray-900">
                    Bon retour 👋
                </h2>

                <p class="text-sm text-gray-400">
                    Connectez-vous à votre compte
                </p>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm font-semibold text-gray-700">Email</label>
                    <div class="relative mt-1.5">
                        <i data-lucide="mail"
                           class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                        <input type="email" name="email"
                               class="field-base pl-10"
                               placeholder="email@exemple.com" required>
                    </div>
                </div>

                {{-- PASSWORD + SHOW --}}
                <div x-data="{ show:false }">
                    <label class="text-sm font-semibold text-gray-700">Mot de passe</label>

                    <div class="relative mt-1.5">
                        <i data-lucide="lock"
                           class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                        <input :type="show ? 'text' : 'password'"
                               name="password"
                               class="field-base pl-10 pr-10"
                               placeholder="••••••••" required>

                        <button type="button"
                                @click="show = !show"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-orange-500">
                            <i :data-lucide="show ? 'eye-off' : 'eye'" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                {{-- REMEMBER --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                           class="rounded border-gray-300 text-orange-500">
                    <span class="text-sm text-gray-500">Se souvenir de moi</span>
                </div>

                {{-- SUBMIT --}}
                <button class="btn-submit" type="submit">
                    Se connecter
                </button>

                {{-- DIVIDER --}}
                <div class="divider my-6">ou</div>

                {{-- GOOGLE LOGIN --}}
                <a href="{{ route('google.redirect') }}" class="google-btn">
                    <svg class="w-4 h-4" viewBox="0 0 24 24">
                        <path fill="#EA4335"
                              d="M12 10.2v3.9h5.5c-.2 1.4-1.7 4-5.5 4a6.1 6.1 0 1 1 0-12c1.7 0 2.9.7 3.6 1.3l2.5-2.4C16.9 3.7 14.7 3 12 3a9 9 0 1 0 0 18c5.2 0 8.6-3.6 8.6-8.8 0-.6-.1-1-.2-1.4H12z"/>
                    </svg>
                    Continue with Google
                </a>

            </form>

        </div>
    </div>
</div>

@endsection