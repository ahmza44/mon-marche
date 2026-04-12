@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- TITLE --}}
    <h1 class="text-3xl font-bold mb-8 text-gray-900">
        🛒 Mon Panier
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($cart))
        <div class="text-center py-20">
            <p class="text-gray-400 text-lg">Panier vide 😢</p>
        </div>
    @else

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- LEFT: PRODUCTS --}}
        <div class="lg:col-span-2 space-y-4">

            @php $total = 0; @endphp

            @foreach($cart as $item)

                @php
                    $product = $item['product'] ?? \App\Models\Product::find($item['product_id']);
                    if (!$product) continue;

                    $lineTotal = $product->price * $item['quantity'];
                    $total += $lineTotal;
                @endphp

                <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition flex gap-4 items-center">

                    {{-- IMAGE --}}
                    <img
                        src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/100' }}"
                        class="w-20 h-20 rounded-xl object-cover"
                    >

                    {{-- INFO --}}
                    <div class="flex-1">
                        <h2 class="font-semibold text-gray-900">
                            {{ $product->name }}
                        </h2>

                        <p class="text-sm text-gray-400 mt-1">
                            Prix: {{ number_format($product->price, 0) }} MAD
                        </p>

                        <p class="text-sm mt-1">
                            Quantité: <span class="font-medium">{{ $item['quantity'] }}</span>
                        </p>
                    </div>

                    {{-- TOTAL --}}
                    <div class="text-right">
                        <p class="font-bold text-orange-500 text-lg">
                            {{ number_format($lineTotal, 0) }} MAD
                        </p>

                        {{-- REMOVE --}}
                        <form method="POST" action="{{ route('customer.cart.remove', $product->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="text-xs text-red-500 hover:underline mt-2">
                                Supprimer
                            </button>
                        </form>
                    </div>

                </div>

            @endforeach

        </div>

        {{-- RIGHT: SUMMARY --}}
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm h-fit">

            <h2 class="text-lg font-semibold mb-4">
                Résumé
            </h2>

            <div class="flex justify-between mb-3 text-sm">
                <span class="text-gray-500">Sous-total</span>
                <span>{{ number_format($total, 0) }} MAD</span>
            </div>

            <div class="flex justify-between mb-3 text-sm">
                <span class="text-gray-500">Livraison</span>
                <span class="text-green-500 font-medium">Gratuite</span>
            </div>

            <div class="border-t pt-4 flex justify-between font-bold text-lg">
                <span>Total</span>
                <span class="text-orange-500">{{ number_format($total, 0) }} MAD</span>
            </div>

            {{-- BUTTONS --}}
            <form method="POST" action="{{ route('customer.checkout') }}" class="mt-6">
                @csrf
                <button class="w-full bg-orange-500 hover:bg-orange-600 text-black py-3 rounded-xl font-semibold transition">
                    Confirmer la commande
                </button>
            </form>

            <form method="POST" action="{{ route('customer.cart.clear') }}" class="mt-3">
                @csrf
                <button class="w-full border border-gray-200 py-3 rounded-xl hover:bg-gray-50 transition text-sm">
                    Vider le panier
                </button>
            </form>

        </div>

    </div>

    @endif

</div>

@endsection