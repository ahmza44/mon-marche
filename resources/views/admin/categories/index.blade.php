@extends('layouts.app')

@section('content')

<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">
            Catégories
        </h2>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-xl text-sm">
            + Nouvelle catégorie
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="p-3 text-left">Image</th>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Produits</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($categories as $category)
                <tr class="hover:bg-gray-50">

                    <td class="p-3">
                        <img src="{{ asset('storage/'.$category->image) }}"
                             class="w-12 h-12 rounded-lg object-cover">
                    </td>

                    <td class="p-3 font-semibold text-gray-800">
                        {{ $category->name }}
                    </td>

                    <td class="p-3 text-orange-600 font-medium">
                        {{ $category->products->count() }} produits
                    </td>

                    <td class="p-3 flex gap-3 text-sm">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="text-blue-600">Edit</a>

                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection