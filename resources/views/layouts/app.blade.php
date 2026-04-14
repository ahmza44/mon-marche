<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mon Marché</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-50 text-gray-800">

<div class="min-h-screen flex flex-col">

{{-- ================= NAVBAR ================= --}}
<header x-data="{ open:false }" class="bg-white shadow-sm sticky top-0 z-50">

    {{-- TOP LINE --}}
    <div class="h-[3px] bg-gradient-to-r from-orange-500 to-orange-300"></div>

    <div class="max-w-7xl mx-auto px-5 h-16 flex items-center">

        {{-- LEFT --}}
        <div class="flex items-center gap-8">

            {{-- LOGO --}}
            <a href="{{ route('customer.accueil') }}" class="flex items-center gap-2">
                <img src="{{ asset('storage/logo/logo.png') }}" class="w-9 h-9">
                <span class="text-lg font-semibold">
                    Mon <span class="text-orange-500">Marché</span>
                </span>
            </a>

            {{-- LINKS --}}
            <nav class="hidden md:flex gap-6 text-sm">

                <a href="{{ route('customer.accueil') }}"
                   class="hover:text-orange-500 {{ request()->routeIs('customer.accueil') ? 'text-orange-500' : '' }}">
                    Accueil
                </a>

                <a href="{{ route('customer.products') }}"
                   class="hover:text-orange-500 {{ request()->routeIs('customer.products') ? 'text-orange-500' : '' }}">
                    Produits
                </a>

                <a href="{{ route('customer.categories') }}"
                   class="hover:text-orange-500 {{ request()->routeIs('customer.categories') ? 'text-orange-500' : '' }}">
                    Catégories
                </a>

            </nav>

        </div>

        {{-- RIGHT --}}
        <div class="ml-auto flex items-center gap-4">

            {{-- CART --}}
            <a href="{{ route('shop.cart') }}"
               class="relative p-2 rounded-lg border hover:border-orange-400">

                <i data-lucide="shopping-cart" class="w-5 h-5"></i>

                @if(count(session('cart', [])) > 0)
                    <span class="absolute -top-1 -right-1 bg-orange-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">
                        {{ count(session('cart', [])) }}
                    </span>
                @endif
            </a>

            {{-- AUTH --}}
            @auth('customer')
            <div x-data="{ open:false }" class="relative">

                {{-- USER BUTTON --}}
                <button @click="open=!open"
                        class="flex items-center gap-2 border rounded-full px-2 py-1">
               @php
              $user = auth('customer')->user();
             @endphp

              <img src="{{ $user && $user->avatar
             ? (str_starts_with($user->avatar, 'http')
               ? $user->avatar
               : Storage::url($user->avatar))
              : asset('storage/avatars/default.png') }}"
                   class="w-7 h-7 rounded-full object-cover">

                    <span class="text-sm hidden sm:block">
                        {{ auth('customer')->user()->name }}
                    </span>
                </button>

                {{-- DROPDOWN --}}
                <div x-show="open"
                     @click.outside="open=false"
                     class="absolute right-0 mt-2 w-52 bg-white border rounded-xl shadow-lg overflow-hidden">

                    <a href="{{ route('profile.edit') }}"
                       class="block px-4 py-2 hover:bg-gray-100">
                        Profil
                    </a>

                    <a href="{{ route('profile.password') }}"
                       class="block px-4 py-2 hover:bg-gray-100">
                        Mot de passe
                    </a>

                    {{-- DASHBOARD (ONLY ADMIN) --}}
                    @if(auth('customer')->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="block px-4 py-2 hover:bg-gray-100 text-green-600 font-medium">
                            Dashboard
                        </a>
                    @endif

                    {{-- DELETE ACCOUNT --}}
                   
                       <a href="{{ route('profile.supprimer') }}"
                       class="block px-4 py-2 hover:bg-red-100">
                        supprimer le compte
                    </a>
                  

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-500">
                            Logout
                        </button>
                    </form>

                </div>
            </div>
            @endauth

            {{-- GUEST --}}
            @guest('customer')
                <a href="{{ route('login') }}" class="text-sm">Login</a>
                <a href="{{ route('register') }}"
                   class="bg-orange-500 text-white px-3 py-1 rounded-lg text-sm">
                    Register
                </a>
            @endguest

            {{-- MOBILE MENU BTN --}}
            <button @click="open = !open" class="md:hidden">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" class="md:hidden px-5 pb-4 space-y-2 bg-white border-t">

        <a href="{{ route('customer.accueil') }}" class="block py-2">Accueil</a>
        <a href="{{ route('customer.products') }}" class="block py-2">Produits</a>
        <a href="{{ route('customer.categories') }}" class="block py-2">Catégories</a>

    </div>

</header>

{{-- CONTENT --}}
<main class="flex-1 max-w-7xl mx-auto w-full px-4 py-6">
    @yield('content')
</main>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) lucide.createIcons();
});
</script>

</body>
</html>