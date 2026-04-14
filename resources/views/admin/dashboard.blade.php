@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">
            Bonjour, <span class="text-orange-500">{{ auth()->user()->name }}</span> 👋
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Tableau de bord administrateur — aperçu global de votre business
        </p>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-gray-500">Produits</p>
            <h2 class="text-3xl font-bold text-orange-500 mt-2">{{ $productsCount ?? 0 }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-gray-500">Catégories</p>
            <h2 class="text-3xl font-bold text-gray-900 mt-2">{{ $categoriesCount ?? 0 }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-gray-500">Clients</p>
            <h2 class="text-3xl font-bold text-orange-600 mt-2">{{ $customersCount ?? 0 }}</h2>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
            <p class="text-xs text-gray-500">Commandes</p>
            <h2 class="text-3xl font-bold text-green-600 mt-2">{{ $ordersCount ?? 0 }}</h2>
        </div>

    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LATEST PRODUCTS --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-900">
                    Derniers produits
                </h2>
            </div>

            <div class="divide-y divide-gray-100">

                @forelse($latestProducts ?? [] as $product)

                <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">

                    <div>
                        <p class="font-semibold text-gray-900">
                            {{ $product->name }}
                        </p>
                        <p class="text-xs text-gray-400">
                            {{ $product->category->name ?? 'Sans catégorie' }}
                        </p>
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-orange-500">
                            {{ number_format($product->price, 2) }} DH
                        </p>
                        <p class="text-xs text-gray-400">
                            Stock: {{ $product->stock }}
                        </p>
                    </div>

                </div>

                @empty

                <div class="px-6 py-10 text-center text-gray-400">
                    Aucun produit disponible
                </div>

                @endforelse

            </div>
        </div>

        {{-- SIDE --}}
        <div class="space-y-6">

            {{-- QUICK ACTIONS --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

                <h2 class="text-lg font-semibold text-gray-900 mb-5">
                    Accès rapide
                </h2>

                <div class="space-y-3">

                    <a href="{{ route('admin.products.index') }}"
                       class="block text-center bg-orange-500 text-black py-3 rounded-xl font-semibold hover:bg-orange-600 transition">
                        Produits
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="block text-center bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-900 transition">
                        Catégories
                    </a>

                    <a href="{{ route('admin.customers.index') }}"
                       class="block text-center border border-gray-200 py-3 rounded-xl hover:border-orange-500 hover:text-orange-500 transition">
                        Clients
                    </a>

                    <a href="{{ route('admin.orders.index') }}"
                       class="block text-center bg-green-500 text-white py-3 rounded-xl font-semibold hover:bg-green-600 transition">
                        Commandes
                    </a>

                </div>
            </div>

            {{-- PROFILE --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">

                <h2 class="text-lg font-semibold text-gray-900 mb-4">
                    Profil
                </h2>

                <div class="flex items-center gap-4 mb-5">

                    <div class="w-12 h-12 rounded-full bg-orange-500 text-black flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-semibold text-gray-900">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                </div>

                <a href="{{ route('profile.edit') }}"
                   class="block text-center border border-gray-200 py-3 rounded-xl hover:bg-gray-50 transition font-medium">
                    Modifier profil
                </a>

            </div>

        </div>

    </div>

</div>

@endsection