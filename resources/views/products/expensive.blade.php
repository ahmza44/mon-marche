@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Produits > 100 MAD</h2>

<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 px-2 md:px-0">
    @foreach($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>

@endsection