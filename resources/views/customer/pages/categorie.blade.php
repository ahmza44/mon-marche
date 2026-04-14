@extends('layouts.app')

@section('content')

<div class="mt-10">

    {{-- HEADER --}}
    <h2 class="text-xl font-bold text-gray-900 mb-5">
        Catégories
    </h2>

    {{-- GRID --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

        @forelse($categories as $category)

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
                        {{ $category->products_count }} produits
                    </p>

                </div>

            </a>

        @empty

            <div class="col-span-4 text-center text-gray-400 py-10">
                Aucune catégorie disponible
            </div>

        @endforelse

    </div>

</div>
<x-footer-component/>
@endsection