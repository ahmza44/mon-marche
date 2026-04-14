@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl">

    <h2 class="text-xl font-bold mb-6">Nouvelle commande</h2>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        {{-- CLIENT --}}
        <div class="mb-4">
            <label class="text-sm">Client</label>
            <select name="customer_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Choisir --</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <label class="text-sm">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                
            </select>
        </div>

        <button class="bg-red-600 text-white px-5 py-2 rounded">
            Créer
        </button>

    </form>

</div>
@endsection