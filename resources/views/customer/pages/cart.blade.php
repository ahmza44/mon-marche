@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold mb-8">
        🛒 Mon Panier
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- EMPTY CHECK --}}
    @if(empty($cartItems) || count($cartItems) === 0)

        <div class="text-center py-20 text-gray-400">
            Panier vide 😢
        </div>

    @else

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- ITEMS --}}
        <div class="lg:col-span-2 space-y-4">

            @foreach($cartItems as $item)

                <div class="bg-white p-4 rounded-xl shadow flex items-center justify-between">

                    <div class="flex items-center gap-4">

                        <img src="{{ $item['product']->image ? asset('storage/'.$item['product']->image) : 'https://via.placeholder.com/80' }}"
                             class="w-16 h-16 rounded object-cover">

                        <div>
                            <h3 class="font-bold">{{ $item['product']->name }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $item['quantity'] }} x {{ $item['product']->price }} MAD
                            </p>
                        </div>

                    </div>

                    <div class="text-right">
                        <p class="font-bold text-orange-500">
                            {{ $item['subtotal'] }} MAD
                        </p>

                        <form method="POST" action="{{ route('shop.cart.remove', $item['product']->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500 text-xs mt-2">
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>

            @endforeach

        </div>

        {{-- SUMMARY --}}
        <div class="bg-white p-6 rounded-xl shadow h-fit">

            <h2 class="text-lg font-bold mb-4">Résumé</h2>

            <div class="flex justify-between mb-3">
                <span>Total</span>
                <span class="font-bold text-orange-500">
                    {{ $total }} MAD
                </span>
            </div>

            <form method="POST" action="{{ route('shop.checkout') }}">
                @csrf
                <button class="w-full bg-orange-500 text-black py-3 rounded-xl">
                    Confirmer commande
                </button>
            </form>

            <form method="POST" action="{{ route('shop.cart.clear') }}" class="mt-3">
                @csrf
                <button class="w-full border py-3 rounded-xl">
                    Vider panier
                </button>
            </form>

        </div>

    </div>

    @endif

</div>

@endsection