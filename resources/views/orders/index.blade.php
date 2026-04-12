@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-bold mb-6">Gestion des commandes</h1>

    <div class="bg-white rounded-xl shadow border overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Montant</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($orders as $order)
                    <tr class="border-b">

                        {{-- ID --}}
                        <td class="px-4 py-3">#{{ $order->id }}</td>

                        {{-- CLIENT --}}
                        <td class="px-4 py-3">
                            {{ $order->customer->name ?? '—' }}
                        </td>

                        {{-- TOTAL --}}
                        <td class="px-4 py-3">
                            {{ number_format($order->total, 2) }} DH
                        </td>

                        {{-- STATUS --}}
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs
                                {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-700' : '' }}">
                                
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>

                        {{-- DATE --}}
                        <td class="px-4 py-3">
                            {{ $order->created_at->format('d/m/Y') }}
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-4 py-3 flex gap-2 items-center">

                            {{-- VIEW --}}
                            <a href="{{ route('orders.show', $order) }}"
                               class="text-blue-600 hover:underline text-sm">
                                Voir
                            </a>

                            {{-- STATUS UPDATE --}}
                            <form action="{{ route('orders.status', $order) }}"
                                  method="POST">
                                @csrf

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="text-xs border rounded px-2 py-1">

                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                        Delivered
                                    </option>
                                </select>
                            </form>

                        </td>

                    </tr>
                @empty

                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-400">
                            Aucune commande trouvée.
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $orders->links() }}
    </div>

</div>
@endsection