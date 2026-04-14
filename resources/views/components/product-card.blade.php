@props(['product'])

@php
    $oldPrice = $product->old_price ?? ($product->price + round($product->price * 0.2));
    $discount = $oldPrice > 0 ? round((1 - $product->price / $oldPrice) * 100) : 0;
@endphp

<div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">

    {{-- IMAGE --}}
    <div class="relative overflow-hidden bg-gray-50 h-44">

        <img
            src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300x200' }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
            alt="{{ $product->name }}"
        >

        {{-- DARK OVERLAY ON HOVER --}}
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition"></div>

        {{-- DISCOUNT --}}
        @if($discount > 0)
        <span class="absolute top-2 left-2 bg-orange-500 text-black text-[11px] font-bold px-2 py-0.5 rounded-full">
            -{{ $discount }}%
        </span>
        @endif

        {{-- QUICK ADD BUTTON (hover only) --}}
        <form action="{{ route('shop.cart.add', $product->id) }}" method="POST"
              class="absolute bottom-2 right-2 opacity-0 group-hover:opacity-100 transition">
            @csrf
            <button type="submit"
                class="w-9 h-9 flex items-center justify-center bg-black text-white rounded-full hover:bg-orange-500 transition shadow-lg">
                🛒
            </button>
        </form>

    </div>

    {{-- CONTENT --}}
    <div class="p-3">

        {{-- NAME --}}
        <h3 class="text-sm font-semibold text-gray-800 line-clamp-1 mb-1">
            {{ $product->name }}
        </h3>

        {{-- PRICE --}}
        <div class="flex items-center justify-between">

            <div>
                <span class="text-lg font-bold text-gray-900">
                    {{ number_format($product->price, 0) }}
                    <span class="text-xs font-medium">DH</span>
                </span>

                @if($discount > 0)
                <div class="text-[11px] text-gray-400 line-through">
                    {{ number_format($oldPrice, 0) }} DH
                </div>
                @endif
            </div>

            {{-- SMALL BADGE --}}
            <span class="text-[10px] px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full">
                Produit
            </span>

        </div>

    </div>

</div>