@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

        <!-- HEADER -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Ajouter un produit</h2>
            <p class="text-sm text-gray-400">Remplissez les informations du produit</p>
        </div>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LEFT SIDE -->
                <div class="space-y-5">

                    <!-- NAME -->
                    <div>
                        <label class="text-sm text-gray-600">Nom</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full mt-1 px-4 py-2 border rounded-xl outline-none transition
                            focus:ring-2 focus:ring-orange-500">

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PRICE -->
                    <div>
                        <label class="text-sm text-gray-600">Prix (MAD)</label>
                        <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                            class="w-full mt-1 px-4 py-2 border rounded-xl outline-none transition
                            focus:ring-2 focus:ring-orange-500">

                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- STOCK -->
                    <div>
                        <label class="text-sm text-gray-600">Stock</label>
                        <input type="number" name="stock" value="{{ old('stock') }}"
                            class="w-full mt-1 px-4 py-2 border rounded-xl outline-none transition
                            focus:ring-2 focus:ring-orange-500">

                        @error('stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CATEGORY -->
                    <div>
                        <label class="text-sm text-gray-600">Catégorie</label>

                        <select name="category_id"
                            class="w-full mt-1 px-4 py-2 border rounded-xl outline-none
                            focus:ring-2 focus:ring-orange-500">

                            <option value="">Choisir...</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="space-y-5">

                    <!-- DESCRIPTION -->
                    <div>
                        <label class="text-sm text-gray-600">Description</label>

                        <textarea name="description" rows="5"
                            class="w-full mt-1 px-4 py-2 border rounded-xl outline-none transition
                            focus:ring-2 focus:ring-orange-500">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IMAGE UPLOAD -->
                    <div>
                        <label class="text-sm text-gray-600">Image</label>

                        <div id="dropzone"
                            class="mt-2 border-2 border-dashed rounded-xl p-6 text-center cursor-pointer
                            hover:border-orange-500 hover:bg-orange-50 transition">

                            <p class="text-gray-400 text-sm">
                                Glisser ou cliquer pour ajouter une image
                            </p>

                            <input type="file" name="image" id="imageInput" class="hidden" accept="image/*">
                        </div>

                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <!-- PREVIEW -->
                        <div class="mt-4 flex justify-center">
                            <img id="preview"
                                class="hidden w-40 h-40 object-cover rounded-xl shadow border"
                                alt="preview">
                        </div>
                    </div>

                </div>
            </div>

            <!-- BUTTON -->
            <div class="mt-8 flex justify-end">
                <button
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-xl shadow transition">
                    Ajouter produit
                </button>
            </div>

        </form>

    </div>
</div>

<!-- JS -->
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