@extends('layouts.app')

@section('header')
<h2 class="text-base font-semibold text-gray-800">Catégories / modifier</h2>
@endsection

@section('content')
<div class="max-w-lg">
    <div class="bg-white rounded-xl border border-gray-200 p-6">

        <h3 class="text-base font-semibold text-gray-800 mb-6">
            Modifier la catégorie
        </h3>

        <form method="POST"
              action="{{ route('admin.categories.update', $category) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="space-y-4">

                <!-- IMAGE -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>

                    <input type="file" name="image"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm">

                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- current image -->
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}"
                             class="w-16 h-16 mt-2 rounded-lg object-cover">
                    @endif
                </div>

                <!-- NAME -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>

                    <input type="text" name="name"
                           value="{{ old('name', $category->name) }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500">

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- BUTTONS -->
            <div class="flex items-center gap-3 mt-6 pt-4 border-t border-gray-100">

                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-5 py-2 rounded-lg">
                    Mettre à jour
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="text-sm text-gray-500 hover:text-gray-700">
                    Annuler
                </a>

            </div>

        </form>

    </div>
</div>
@endsection