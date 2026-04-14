@extends('layouts.app')

@section('content')

<div class="mt-10 space-y-10">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">
            Admin - Produits
        </h2>

        <a href="{{ route('admin.products.create') }}"
           class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
            + Ajouter produit
        </a>
    </div>

    {{-- ================= TABLE ================= --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-sm text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Image</th>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Prix</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr class="border-b">

                    <td class="p-3">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-10 h-10 rounded object-cover">
                    </td>

                    <td class="p-3">
                        {{ $product->name }}
                    </td>

                    <td class="p-3">
                        {{ $product->price }} DH
                    </td>

                    <td class="p-3">
                        {{ $product->stock }}
                    </td>

                    <td class="p-3 text-right">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="text-blue-500">Edit</a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500 ml-2">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    {{-- ================= CARDS (USING YOUR COMPONENT) ================= --}}
    <div>

        <h3 class="text-lg font-semibold text-gray-700 mb-4">
            Preview produits
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach

        </div>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>

@endsection