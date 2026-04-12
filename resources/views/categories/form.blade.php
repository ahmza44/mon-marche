@extends('layouts.app')

@section('header')
    <h2 class="text-base font-semibold text-gray-800">Catégories</h2>
    <span class="text-sm text-gray-400 ml-2">
        / {{ isset($category) ? 'modifier' : 'nouvelle' }}
    </span>
@endsection

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl border border-gray-200 p-6">

        <h3 class="text-base font-semibold text-gray-800 mb-6">
            {{ isset($category) ? 'Modifier la catégorie' : 'Nouvelle catégorie' }}
        </h3>

        <form method="POST"
              enctype="multipart/form-data"
              action="{{ isset($category)
                        ? route('categories.update', $category)
                        : route('categories.store') }}">

            @csrf
            @if(isset($category)) @method('PUT') @endif

            <div class="space-y-4">

                <!-- IMAGE -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Image
                    </label>

                    <input type="file" name="image"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">

                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- preview -->
                    @if(isset($category) && $category->image)
                        <img src="{{ asset('storage/'.$category->image) }}"
                             class="w-16 h-16 mt-2 rounded-lg object-cover">
                    @endif
                </div>

                <!-- NAME -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" name="name"
                           value="{{ old('name', $category->name ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500"
                           placeholder="Nom de la catégorie">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DESCRIPTION -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                              placeholder="Description (optionnel)">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

            </div>

            <!-- BUTTONS -->
            <div class="flex items-center gap-3 mt-6 pt-4 border-t border-gray-100">

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2 rounded-lg">
                    {{ isset($category) ? 'Mettre à jour' : 'Enregistrer' }}
                </button>

                <a href="{{ route('categories.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700">
                    Annuler
                </a>

            </div>

        </form>
    </div>
</div>
@endsection