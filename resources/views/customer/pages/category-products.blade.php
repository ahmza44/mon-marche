@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-8">

    {{-- HEADER --}}
    <h1 class="text-2xl font-bold mb-6">
        {{ $category->name }}
    </h1>

    {{-- PRODUCTS GRID --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        @forelse($products as $product)

            {{-- ✅ USING YOUR COMPONENT --}}
            <x-product-card :product="$product" />

        @empty

            <div class="col-span-3 text-center text-gray-400 py-10">
                Aucun produit dans cette catégorie
            </div>

        @endforelse

    </div>

</div>
<x-footer-component/>
@endsection