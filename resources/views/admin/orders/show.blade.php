@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">

    {{-- ORDER HEADER --}}
    <h1 class="text-2xl font-bold mb-4">
        Order #{{ $order->id }}
    </h1>

    @php
        $statusColors = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'delivered' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
        ];
    @endphp

    {{-- ORDER INFO --}}
    <div class="bg-white p-4 rounded-xl shadow border mb-6 space-y-1">

        <p class="text-gray-700">
            <span class="font-semibold">Client:</span>
            {{ $order->customer->name ?? '—' }}
        </p>

        <p class="text-gray-700">
            <span class="font-semibold">Email:</span>
            {{ $order->customer->email ?? '—' }}
        </p>

        <p class="text-gray-700">
            <span class="font-semibold">Status:</span>

            <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$order->status] ?? '' }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>

    </div>

    {{-- ITEMS TABLE --}}
    <div class="bg-white border rounded-xl overflow-hidden shadow">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-3 text-left">Produit</th>
                    <th class="p-3 text-left">Prix</th>
                    <th class="p-3 text-left">Quantité</th>
                    <th class="p-3 text-left">Sous-total</th>
                </tr>
            </thead>

            <tbody>
                @forelse($order->items as $item)

                    @php
                        $subtotal = $item->price * $item->quantity;
                    @endphp

                    <tr class="border-t hover:bg-gray-50">

                        {{-- PRODUCT --}}
                        <td class="p-3 flex items-center gap-2">

                            @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/'.$item->product->image) }}"
                                     class="w-10 h-10 rounded object-cover">
                            @endif

                            <span>
                                {{ $item->product->name ?? 'Produit supprimé' }}
                            </span>

                        </td>

                        {{-- PRICE --}}
                        <td class="p-3">
                            {{ number_format($item->price, 2) }} DH
                        </td>

                        {{-- QTY --}}
                        <td class="p-3">
                            {{ $item->quantity }}
                        </td>

                        {{-- SUBTOTAL --}}
                        <td class="p-3 font-semibold text-red-600">
                            {{ number_format($subtotal, 2) }} DH
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">
                            No items found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    </div>

</div>
@endsection