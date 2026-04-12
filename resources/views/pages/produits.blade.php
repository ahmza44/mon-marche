@extends('layouts.app')

@section('content')

@auth
@if(auth()->user()->role === 'admin')

<div class="mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">

    {{-- SEARCH --}}
    <form action="{{ route('products.index') }}" method="GET" class="w-full md:max-w-md mb-4">
        <div class="relative">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Rechercher un produit..."
                   class="w-full border border-gray-200 rounded-xl pl-4 pr-10 py-2 text-sm
                          focus:ring-2 focus:ring-orange-500 focus:outline-none">

            <button type="submit"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                🔍
            </button>
        </div>
    </form>

    {{-- ACTION BUTTONS --}}
    <div class="flex flex-wrap gap-2">

        <a href="{{ route('products.expensive') }}"
           class="bg-black text-white px-4 py-2 rounded-xl text-sm hover:bg-gray-800 transition">
            +100 MAD
        </a>

        <a href="{{ route('products.sort.price.desc') }}"
           class="bg-orange-500 text-black px-4 py-2 rounded-xl text-sm hover:bg-orange-600 transition font-medium">
            Prix ↓
        </a>

        <a href="{{ route('products.top5') }}"
           class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-xl text-sm hover:border-orange-500 hover:text-orange-500 transition">
            Top 5
        </a>

        <a href="{{ route('products.create') }}"
           class="bg-orange-500 text-black px-4 py-2 rounded-xl text-sm font-semibold hover:bg-orange-600 transition shadow-sm">
            + Nouveau produit
        </a>

    </div>

    {{-- COUNT --}}
    <p class="text-xs text-gray-500 mt-3">
        Total:
        <span class="font-semibold text-black">
            {{ $products instanceof \Illuminate\Pagination\LengthAwarePaginator ? $products->total() : $products->count() }}
        </span>
    </p>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Image</th>
                <th class="px-4 py-3 text-left">Nom</th>
                <th class="px-4 py-3 text-left">Catégorie</th>
                <th class="px-4 py-3 text-left">Prix</th>
                <th class="px-4 py-3 text-left">Stock</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">

        @forelse($products as $product)

            <tr class="hover:bg-gray-50 transition">

                <td class="px-4 py-3 text-gray-500">{{ $product->id }}</td>

                <td class="px-4 py-3">
                    <img src="{{ $product->image 
                        ? asset('storage/'.$product->image) 
                        : 'https://via.placeholder.com/60' }}"
                         class="w-12 h-12 rounded-lg object-cover border">
                </td>

                <td class="px-4 py-3 font-medium text-gray-800">
                    {{ $product->name }}
                </td>

                <td class="px-4 py-3 text-gray-600">
                    {{ $product->category->name ?? '-' }}
                </td>

                <td class="px-4 py-3 font-semibold text-orange-500">
                    {{ $product->price }} MAD
                </td>

                <td class="px-4 py-3 text-gray-600">
                    {{ $product->stock }}
                </td>

                <td class="px-4 py-3">

                    <div class="flex gap-3 text-xs">

                        <a href="{{ route('products.edit', $product->id) }}"
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 font-medium"
                                    onclick="return confirm('Delete product?')">
                                Delete
                            </button>
                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="text-center py-8 text-gray-400">
                    No products found
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

</div>

@endif
@endauth


{{-- ================= CUSTOMER VIEW ================= --}}
<div class="mt-10">

    <h2 class="text-xl font-bold text-gray-800 mb-4">
        Produits
    </h2>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($products as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>

    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>

</div>

@endsection