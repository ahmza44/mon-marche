@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl">

    <h2 class="text-xl font-bold mb-6">
        Modifier commande #{{ $order->id }}
    </h2>

    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf
        @method('PUT')

        {{-- CLIENT --}}
        <div class="mb-4">
            <label class="text-sm">Client</label>
            <select name="customer_id" class="w-full border rounded px-3 py-2">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <label class="text-sm">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
               
            </select>
        </div>

        <button class="bg-blue-600 text-white px-5 py-2 rounded">
            Mettre à jour
        </button>

    </form>

</div>
@endsection