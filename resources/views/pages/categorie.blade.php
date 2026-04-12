@extends('layouts.app')

@section('content')

@auth
@if(auth()->user()->role === 'admin')

{{-- ================= ADMIN HEADER ================= --}}
<div class="mb-6 flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">

    <p class="text-sm text-gray-500">
        <span class="font-semibold text-gray-900">{{ $categories->count() }}</span> catégorie(s)
    </p>

    <a href="{{ route('categories.create') }}"
       class="bg-orange-500 hover:bg-orange-600 text-black font-semibold text-sm px-4 py-2 rounded-xl shadow-sm transition">
        + Nouvelle catégorie
    </a>

</div>

{{-- ================= TABLE ================= --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Image</th>
                <th class="px-4 py-3 text-left">Nom</th>
                <th class="px-4 py-3 text-left">Produits</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">

        @foreach($categories as $category)

        <tr class="hover:bg-gray-50 transition">

            <td class="px-4 py-3 text-gray-500">
                {{ $category->id }}
            </td>

            <td class="px-4 py-3">
                <div class="w-12 h-12 rounded-xl overflow-hidden border border-gray-100">
                    <img src="{{ $category->image 
                        ? asset('storage/'.$category->image) 
                        : 'https://via.placeholder.com/60' }}"
                         class="w-full h-full object-cover">
                </div>
            </td>

            <td class="px-4 py-3 font-semibold text-gray-800">
                {{ $category->name }}
            </td>

            <td class="px-4 py-3">
                <span class="px-3 py-1 text-xs rounded-full bg-orange-100 text-orange-600 font-semibold">
                    {{ $category->products->count() }} produits
                </span>
            </td>

            <td class="px-4 py-3">

                <div class="flex items-center gap-3 text-xs">

                    <a href="{{ route('categories.edit', $category) }}"
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('categories.destroy', $category) }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-500 hover:text-red-700 font-medium"
                                onclick="return confirm('Delete category?')">
                            Delete
                        </button>
                    </form>

                </div>

            </td>

        </tr>

        @endforeach

        </tbody>
    </table>

</div>

@endif
@endauth


{{-- ================= CUSTOMER VIEW ================= --}}
<div class="mt-10">

    <h2 class="text-xl font-bold text-gray-900 mb-5">
        Catégories
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @foreach($categories as $category)

        <a href="{{ route('customer.categories.show', $category->id) }}"
           class="group relative rounded-2xl overflow-hidden aspect-[16/9] shadow-sm border border-gray-100">

            {{-- IMAGE --}}
            @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}"
                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
            @else
                <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-600"></div>
            @endif

            {{-- OVERLAY --}}
            <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition"></div>

            {{-- TEXT --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-3">

                <h3 class="text-white font-bold text-lg drop-shadow">
                    {{ $category->name }}
                </h3>

                <p class="text-white/80 text-xs mt-1">
                    {{ $category->products->count() }} produits
                </p>

            </div>

        </a>

        @endforeach

    </div>

</div>

@endsection