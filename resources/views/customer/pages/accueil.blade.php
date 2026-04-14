@extends('layouts.app')
@section('title', 'Accueil')

@section('content')

{{-- ═════════════ HERO SLIDER ═════════════ --}}
<div class="relative w-full overflow-hidden rounded-2xl mb-6" style="height: 280px;">

    <div id="slider" class="flex h-full transition-transform duration-500 ease-in-out">

        {{-- SLIDES --}}
        @php
            $slides = [
                ['img' => 'storage/logo/selider2.jpg', 'title' => '👉 Achetez maintenant', 'desc' => 'Qualité premium au meilleur prix'],
                ['img' => 'storage/logo/selider3.jpeg', 'title' => 'Produits frais 🥬', 'desc' => 'Fraîcheur garantie chaque jour'],
                ['img' => 'storage/logo/selider1.jpeg', 'title' => 'Livraison rapide 🚚', 'desc' => 'Commandez et recevez chez vous'],
            ];
        @endphp

        @foreach($slides as $slide)
        <div class="min-w-full h-full relative">

            <img src="{{ asset($slide['img']) }}"
                 class="w-full h-full object-cover rounded-2xl">

            <div class="absolute inset-0 bg-black/50 rounded-2xl"></div>

            <div class="absolute inset-0 flex items-center justify-center text-center text-white px-6">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold">
                        {{ $slide['title'] }}
                    </h2>
                    <p class="text-sm opacity-90">
                        {{ $slide['desc'] }}
                    </p>
                </div>
            </div>

        </div>
        @endforeach

    </div>

    {{-- DOTS --}}
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
        <button onclick="goTo(0)" class="w-2 h-2 rounded-full bg-white opacity-50"></button>
        <button onclick="goTo(1)" class="w-2 h-2 rounded-full bg-white opacity-50"></button>
        <button onclick="goTo(2)" class="w-2 h-2 rounded-full bg-white opacity-50"></button>
    </div>

    {{-- ARROWS --}}
    <button onclick="prev()"
        class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 bg-black/40 hover:bg-orange-500 text-white rounded-full">
        ←
    </button>

    <button onclick="next()"
        class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 bg-black/40 hover:bg-orange-500 text-white rounded-full">
        →
    </button>
</div>

{{-- ═════════════ SEARCH ═════════════ --}}
<form action="{{ route('customer.accueil') }}" method="GET" class="w-full md:max-w-md mb-6">
    <div class="relative">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Rechercher un produit..."
               class="w-full border border-gray-200 rounded-lg pl-4 pr-10 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-none">

        <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
            🔍
        </button>
    </div>
</form>

{{-- ═════════════ CATEGORIES ═════════════ --}}
<h2 class="text-sm font-bold text-gray-600 mb-3">Catégories</h2>

<div class="flex gap-2 overflow-x-auto mb-6">

    <a href="{{ route('customer.accueil') }}"
       class="px-4 py-1.5 rounded-full text-xs font-semibold border
       {{ !request('category') ? 'bg-orange-500 text-black' : 'bg-white text-gray-600' }}">
        Tous
    </a>

    @foreach($categories as $category)
        <a href="{{ route('customer.accueil', ['category' => $category->id]) }}"
           class="px-4 py-1.5 rounded-full text-xs font-semibold border
           {{ request('category') == $category->id
               ? 'bg-orange-500 text-black'
               : 'bg-white text-gray-600' }}">
            {{ $category->name }}
        </a>
    @endforeach
</div>

{{-- ═════════════ PRODUCTS ═════════════ --}}
<h2 class="text-sm font-bold text-gray-600 mb-3">Produits</h2>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
    @foreach($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>

{{-- PAGINATION --}}
<div class="mt-6">
    {{ $products->appends(request()->query())->links() }}
</div>

<x-footer-component/>

{{-- ═════════════ SLIDER SCRIPT ═════════════ --}}
<script>
    let current = 0;
    const total = 3;

    function updateSlider() {
        document.getElementById('slider')
            .style.transform = `translateX(-${current * 100}%)`;
    }

    function next() {
        current = (current + 1) % total;
        updateSlider();
    }

    function prev() {
        current = (current - 1 + total) % total;
        updateSlider();
    }

    function goTo(i) {
        current = i;
        updateSlider();
    }

    setInterval(next, 4000);
</script>

@endsection