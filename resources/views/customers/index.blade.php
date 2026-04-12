@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Clients
            </h1>
            <p class="text-sm text-gray-400">
                Gestion des utilisateurs
            </p>
        </div>

        <a href="{{ route('customers.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-black px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-sm">
            + Nouveau client
        </a>
    </div>

    {{-- TOP BAR --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <p class="text-sm text-gray-500">
            {{ $customers->total() }} client(s)
        </p>

        {{-- SEARCH --}}
        <form method="GET" class="w-full md:w-72">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher..."
                       class="w-full pl-4 pr-10 py-2 rounded-xl border border-gray-200 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-none">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
            </div>
        </form>

    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            {{-- HEAD --}}
            <thead class="bg-gray-50 border-b">
                <tr class="text-gray-500 text-xs uppercase tracking-wider">
                    <th class="px-6 py-3 text-left">Client</th>
                    <th class="px-6 py-3 text-left">Contact</th>
                    <th class="px-6 py-3 text-left">Commandes</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody class="divide-y divide-gray-100">

                @forelse($customers as $customer)

                <tr class="hover:bg-gray-50 transition">

                    {{-- CLIENT --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-orange-500 text-black flex items-center justify-center font-bold">
                                {{ strtoupper(substr($customer->name, 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ $customer->name }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    ID: #{{ $customer->id }}
                                </p>
                            </div>

                        </div>
                    </td>

                    {{-- CONTACT --}}
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <p>{{ $customer->email }}</p>
                        <p class="text-xs text-gray-400">
                            {{ $customer->phone ?? '—' }}
                        </p>
                    </td>

                    {{-- ORDERS --}}
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                            {{ $customer->orders_count ?? 0 }} commandes
                        </span>
                    </td>

                    {{-- ACTIONS --}}
                    <td class="px-6 py-4 text-right">

                        <div class="flex justify-end gap-2">

                            <a href="{{ route('customers.edit', $customer) }}"
                               class="px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition">
                                Modifier
                            </a>

                            <form method="POST" action="{{ route('customers.destroy', $customer) }}"
                                  onsubmit="return confirm('Supprimer ce client ?')">
                                @csrf @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-1.5 text-xs font-medium rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition">
                                    Supprimer
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center py-16 text-gray-400">
                        Aucun client trouvé 😢
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $customers->links() }}
    </div>

</div>

@endsection