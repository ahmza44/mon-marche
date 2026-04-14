@extends('layouts.app')

@section('content')

<div class="mt-10">

    <h2 class="text-xl font-bold text-gray-800 mb-4">
        Produits
    </h2>

    {{-- ================= FILTER ================= --}}
    <form method="GET" class="flex flex-wrap gap-2 mb-6">

        <input type="number"
               name="min_price"
               value="{{ request('min_price') }}"
               placeholder="Min price"
               class="border px-3 py-2 rounded-lg text-sm">

        <input type="number"
               name="max_price"
               value="{{ request('max_price') }}"
               placeholder="Max price"
               class="border px-3 py-2 rounded-lg text-sm">

        <button class="bg-orange-500 text-black px-4 py-2 rounded-lg text-sm font-semibold">
            Filter
        </button>

        <a href="{{ route('customer.products') }}"
           class="border px-4 py-2 rounded-lg text-sm">
            Reset
        </a>

    </form>

    {{-- ================= PRODUCTS GRID ================= --}}
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @foreach($products as $product)
            <x-product-card :product="$product" />
        @endforeach

    </div>

    {{-- ================= PAGINATION ================= --}}
    <div class="mt-6">
        {{ $products->appends(request()->query())->links() }}
    </div>

</div>
<x-footer-component/>
@endsection