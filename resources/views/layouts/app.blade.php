<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mon Marché') }} — {{ isset($title) ? $title : 'Boutique' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Figtree', sans-serif; }
        .brand-font { font-family: 'Syne', sans-serif; }

        /* ── Accent bar ── */
        .navbar-accent {
            height: 3px;
            background: linear-gradient(90deg, #FF7A00 0%, #FF9A35 60%, #FFD7A8 100%);
        }

        /* ── Nav links ── */
        .nav-link-pro {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 13px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            color: #4B5563;
            text-decoration: none;
            transition: background .18s, color .18s;
            white-space: nowrap;
        }
        .nav-link-pro:hover {
            background: #FFF4EA;
            color: #FF7A00;
        }
        .nav-link-pro.active {
            background: #FF7A00;
            color: #fff;
            box-shadow: 0 4px 14px rgba(255,122,0,.28);
        }

        /* ── Search ── */
        .search-pro {
            width: 100%;
            padding: 9px 16px 9px 40px;
            border-radius: 50px;
            border: 1.5px solid #E5E7EB;
            background: #F9FAFB;
            font-family: 'Figtree', sans-serif;
            font-size: 13.5px;
            color: #1F2937;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }
        .search-pro::placeholder { color: #9CA3AF; }
        .search-pro:focus {
            border-color: #FF7A00;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(255,122,0,.12);
        }

        /* ── Cart button ── */
        .cart-btn-pro {
            position: relative;
            width: 40px; height: 40px;
            border-radius: 12px;
            border: 1.5px solid #E5E7EB;
            background: #F9FAFB;
            display: flex; align-items: center; justify-content: center;
            color: #4B5563;
            text-decoration: none;
            transition: background .18s, border-color .18s, color .18s, box-shadow .18s;
        }
        .cart-btn-pro:hover {
            background: #FFF4EA;
            border-color: #FF7A00;
            color: #FF7A00;
            box-shadow: 0 4px 12px rgba(255,122,0,.18);
        }

        /* ── User pill ── */
        .user-pill {
            display: flex; align-items: center; gap: 8px;
            padding: 4px 12px 4px 5px;
            border-radius: 50px;
            border: 1.5px solid #E5E7EB;
            background: #fff;
            cursor: pointer;
            transition: border-color .18s, box-shadow .18s;
        }
        .user-pill:hover {
            border-color: #FF7A00;
            box-shadow: 0 2px 12px rgba(255,122,0,.14);
        }
        .user-avatar-ring {
            width: 30px; height: 30px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #FF7A00;
            flex-shrink: 0;
        }
        .user-avatar-ring img { width: 100%; height: 100%; object-fit: cover; }

        /* ── Dropdown ── */
        .dropdown-pro {
            position: absolute;
            right: 0; top: calc(100% + 10px);
            width: 224px;
            background: #fff;
            border: 1.5px solid #F3F4F6;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0,0,0,.11), 0 4px 12px rgba(0,0,0,.05);
            overflow: hidden;
        }
        .dropdown-pro-header {
            padding: 13px 16px;
            border-bottom: 1px solid #F3F4F6;
            background: #FFF4EA;
        }
        .dropdown-pro-item {
            display: flex; align-items: center; gap: 9px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 13px; font-weight: 500;
            color: #374151;
            text-decoration: none;
            transition: background .15s, color .15s;
        }
        .dropdown-pro-item:hover { background: #F9FAFB; color: #FF7A00; }
        .dropdown-pro-item.danger { color: #EF4444; }
        .dropdown-pro-item.danger:hover { background: #FEF2F2; color: #DC2626; }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
<div class="min-h-screen flex flex-col">

    {{-- ═════════════ NAVBAR ═════════════ --}}
    <header
        x-data="{ scrolled: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
        :class="scrolled ? 'shadow-lg' : 'shadow-sm'"
        class="bg-white sticky top-0 z-50 transition-shadow duration-300"
    >
        {{-- Orange accent stripe --}}
        <div class="navbar-accent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center gap-4">

            {{-- LOGO --}}
            <a href="{{ route('customer.accueil') }}" class="flex items-center gap-2.5 shrink-0">
                <div class="w-9 h-9 rounded-xl overflow-hidden flex items-center justify-center
                            bg-gradient-to-br from-orange-500 to-orange-400
                            shadow-[0_4px_12px_rgba(255,122,0,0.35)]">
                    <img src="{{ asset('storage/logo/logo.png') }}"
                         class="w-full h-full object-contain" alt="Mon Marché Logo">
                </div>
                <span class="brand-font text-gray-900 text-xl font-extrabold tracking-tight">
                    Mon <span class="text-orange-500">Marché</span>
                </span>
            </a>

            {{-- SEARCH --}}
            <form action="{{ route('customer.products') }}" method="GET"
                  class="hidden md:flex flex-1 max-w-sm mx-4">
                <div class="relative w-full">
                    <i data-lucide="search"
                       class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>
                    <input type="text" name="search"
                           value="{{ request('search') }}"
                           placeholder="Rechercher un produit..."
                           class="search-pro">
                </div>
            </form>

            {{-- NAV LINKS --}}
            <nav class="hidden md:flex items-center gap-1">
               <a href="{{ route('customer.accueil') }}"
   class="relative flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600
          after:content-[''] after:absolute after:left-3 after:right-3 after:bottom-1
          after:h-[2px] after:bg-[#FF7A00] after:rounded-full
          after:scale-x-0 after:origin-left after:transition-transform after:duration-200
          hover:after:scale-x-100
          {{ request()->routeIs('customer.accueil') ? 'after:scale-x-100 text-gray-600' : '' }}">
    Accueil
</a>

<a href="{{ route('customer.products') }}"
   class="relative flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600
          after:content-[''] after:absolute after:left-3 after:right-3 after:bottom-1
          after:h-[2px] after:bg-[#FF7A00] after:rounded-full
          after:scale-x-0 after:origin-left after:transition-transform after:duration-200
          hover:after:scale-x-100
          {{ request()->routeIs('customer.products') ? 'after:scale-x-100 text-gray-600' : '' }}">
    Produits
</a>

<a href="{{ route('customer.categories') }}"
   class="relative flex items-center gap-2 px-3 py-2 text-sm font-semibold text-gray-600
          after:content-[''] after:absolute after:left-3 after:right-3 after:bottom-1
          after:h-[2px] after:bg-[#FF7A00] after:rounded-full
          after:scale-x-0 after:origin-left after:transition-transform after:duration-200
          hover:after:scale-x-100
          {{ request()->routeIs('customer.categories') ? 'after:scale-x-100 text-gray-600' : '' }}">
    Catégories
</a>

            {{-- RIGHT --}}
            <div class="flex items-center gap-2.5 ml-auto">

                {{-- CART --}}
                <a href="{{ route('customer.cart') }}" class="cart-btn-pro">
                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1.5 -right-1.5 bg-orange-500 text-white
                                     text-[10px] font-bold w-[18px] h-[18px] flex items-center
                                     justify-center rounded-full border-2 border-white
                                     shadow-[0_2px_6px_rgba(255,122,0,.4)]">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Divider --}}
                <div class="hidden md:block w-px h-7 bg-gray-200"></div>

                {{-- AUTH --}}
                @auth
                <div x-data="{ open: false }" class="relative">

                    {{-- User pill trigger --}}
                    <button @click="open = !open" class="user-pill">
                        <div class="user-avatar-ring">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}">
                            @else
                                <img src="{{ asset('storage/avatars/default.png') }}">
                            @endif
                        </div>
                        <span class="hidden sm:block text-sm font-semibold text-gray-800 max-w-[100px] truncate">
                            {{ auth()->user()->name }}
                        </span>
                        <i data-lucide="chevron-down"
                           class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    {{-- DROPDOWN --}}
                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         class="dropdown-pro"
                         style="display:none">

                        {{-- Header --}}
                        <div class="dropdown-pro-header">
                            <p class="text-sm font-bold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ auth()->user()->email }}</p>
                        </div>

                        {{-- Items --}}
                        <div class="p-1.5 flex flex-col gap-0.5">
                            <a href="{{ route('profile.edit') }}" class="dropdown-pro-item">
                                <i data-lucide="user" class="w-4 h-4 shrink-0"></i> Profil
                            </a>
                            <a href="{{ route('profile.password') }}" class="dropdown-pro-item">
                                <i data-lucide="lock" class="w-4 h-4 shrink-0"></i> Mot de passe
                            </a>
                            @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="dropdown-pro-item">
                                <i data-lucide="layout-dashboard" class="w-4 h-4 shrink-0"></i> Dashboard
                            </a>
                            @endif

                            <div class="h-px bg-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-pro-item danger w-full text-left">
                                    <i data-lucide="log-out" class="w-4 h-4 shrink-0"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @else
                    {{-- Guest buttons --}}
                    <a href="{{ route('login') }}"
                       class="hidden sm:inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold
                              text-gray-600 hover:bg-gray-100 transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold
                              text-white bg-orange-500 hover:bg-orange-600 transition
                              shadow-[0_4px_14px_rgba(255,122,0,0.30)]">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 py-6">
        @yield('content')
    </main>


</div>
   
   

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.lucide) lucide.createIcons();
    });
</script>

</body>
</html>