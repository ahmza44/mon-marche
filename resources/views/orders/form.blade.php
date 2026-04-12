@extends('layouts.app')

@section('header')
    <h2 class="text-base font-semibold text-gray-800">Commandes</h2>
    <span class="text-sm text-gray-400 ml-2">/ {{ isset($order) ? 'modifier' : 'nouvelle' }}</span>
@endsection

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-6">
                {{ isset($order) ? 'Modifier la commande #' . $order->id : 'Nouvelle commande' }}
            </h3>

            <form method="POST"
                  action="{{ isset($order) ? route('orders.update', $order) : route('orders.store') }}">
                @csrf
                @if(isset($order)) @method('PUT') @endif

                <div class="space-y-4">

                    {{-- Client --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                        <select name="customer_id"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('customer_id') border-red-500 @enderror">
                            <option value="">-- Choisir un client --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id', $order->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }} — {{ $customer->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Produits --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produits</label>
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="text-left px-3 py-2 text-gray-500 font-medium">Produit</th>
                                        <th class="text-left px-3 py-2 text-gray-500 font-medium w-24">Quantité</th>
                                        <th class="text-left px-3 py-2 text-gray-500 font-medium w-28">Prix unit.</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100" id="products-table">
                                    @if(isset($order) && $order->items->count())
                                        @foreach($order->items as $index => $item)
                                        <tr class="product-row">
                                            <td class="px-3 py-2">
                                                <select name="products[{{ $index }}][id]"
                                                        class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                                                    <option value="">-- Produit --</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}"
                                                            {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                            {{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-3 py-2">
                                                <input type="number" name="products[{{ $index }}][quantity]"
                                                       value="{{ $item->quantity }}" min="1"
                                                       class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                                            </td>
                                            <td class="px-3 py-2">
                                                <input type="number" name="products[{{ $index }}][price]"
                                                       value="{{ $item->price }}" min="0" step="0.01"
                                                       class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr class="product-row">
                                            <td class="px-3 py-2">
                                                <select name="products[0][id]"
                                                        class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                                                    <option value="">-- Produit --</option>
                                                    @foreach($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-3 py-2">
                                                <input type="number" name="products[0][quantity]" value="1" min="1"
                                                       class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                                            </td>
                                            <td class="px-3 py-2">
                                                <input type="number" name="products[0][price]" value="" min="0" step="0.01"
                                                       placeholder="0.00"
                                                       class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <button type="button" id="add-product"
                                class="mt-2 text-xs text-red-600 hover:text-red-700 font-medium">
                            + Ajouter un produit
                        </button>
                    </div>

                    {{-- Statut --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                        <select name="status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="pending"    {{ old('status', $order->status ?? '') == 'pending'   ? 'selected' : '' }}>En attente</option>
                            <option value="confirmed"  {{ old('status', $order->status ?? '') == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                            <option value="shipped"    {{ old('status', $order->status ?? '') == 'shipped'   ? 'selected' : '' }}>Expédiée</option>
                            <option value="delivered"  {{ old('status', $order->status ?? '') == 'delivered' ? 'selected' : '' }}>Livrée</option>
                            <option value="cancelled"  {{ old('status', $order->status ?? '') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <textarea name="notes" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                  placeholder="Notes ou instructions spéciales (optionnel)">{{ old('notes', $order->notes ?? '') }}</textarea>
                    </div>

                </div>

                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                        {{ isset($order) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                    <a href="{{ route('orders.index') }}"
                       class="text-sm text-gray-500 hover:text-gray-700 transition">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let rowIndex = {{ isset($order) ? $order->items->count() : 1 }};
        const products = @json($products->map(fn($p) => ['id' => $p->id, 'name' => $p->name]));

        document.getElementById('add-product').addEventListener('click', function () {
            const options = products.map(p =>
                `<option value="${p.id}">${p.name}</option>`
            ).join('');

            const row = `
                <tr class="product-row">
                    <td class="px-3 py-2">
                        <select name="products[${rowIndex}][id]"
                                class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                            <option value="">-- Produit --</option>
                            ${options}
                        </select>
                    </td>
                    <td class="px-3 py-2">
                        <input type="number" name="products[${rowIndex}][quantity]" value="1" min="1"
                               class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                    </td>
                    <td class="px-3 py-2">
                        <input type="number" name="products[${rowIndex}][price]" value="" min="0" step="0.01"
                               placeholder="0.00"
                               class="w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-red-400">
                    </td>
                </tr>`;

            document.getElementById('products-table').insertAdjacentHTML('beforeend', row);
            rowIndex++;
        });
    </script>
@endsection