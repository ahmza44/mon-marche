@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8">

        {{-- HEADER --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Modifier le produit</h2>
            <p class="text-sm text-gray-400">Mettre à jour les informations</p>
        </div>

        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- LEFT --}}
                <div class="space-y-5">

                    <input type="text" name="name"
                        value="{{ old('name', $product->name) }}"
                        class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500"
                        placeholder="Nom">

                    <input type="number" name="price"
                        value="{{ old('price', $product->price) }}"
                        class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500"
                        placeholder="Prix">

                    <input type="number" name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500"
                        placeholder="Stock">

                    <select name="category_id"
                        class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500">

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                </div>

                {{-- RIGHT --}}
                <div class="space-y-5">

                    <textarea name="description" rows="5"
                        class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500"
                        placeholder="Description">{{ old('description', $product->description) }}</textarea>

                    {{-- IMAGE --}}
                    <div>

                        <div id="dropzone"
                             class="border-2 border-dashed rounded-xl p-6 text-center cursor-pointer hover:border-red-500">

                            <p class="text-gray-400 text-sm">Cliquer pour changer l’image</p>
                            <input type="file" name="image" id="imageInput" class="hidden" accept="image/*">
                        </div>

                        {{-- PREVIEW --}}
                        <div class="mt-4 flex justify-center">

                            @if($product->image)
                                <img id="preview"
                                     src="{{ asset('storage/' . $product->image) }}"
                                     class="w-40 h-40 object-cover rounded-xl shadow">
                            @else
                                <img id="preview"
                                     class="hidden w-40 h-40 object-cover rounded-xl shadow">
                            @endif

                        </div>

                    </div>

                </div>

            </div>

            {{-- BUTTONS --}}
            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('products.index') }}"
                   class="px-4 py-2 text-gray-500 hover:text-gray-700">
                    Annuler
                </a>

                <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-xl">
                    Mettre à jour
                </button>

            </div>

        </form>

    </div>

</div>

<script>
const dropzone = document.getElementById('dropzone');
const input = document.getElementById('imageInput');
const preview = document.getElementById('preview');

dropzone.addEventListener('click', () => input.click());

input.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    }
});
</script>

@endsection