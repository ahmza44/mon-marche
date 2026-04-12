@extends('layouts.app')

@section('header')
    <h2 class="text-base font-semibold text-gray-800">Clients</h2>
    <span class="text-sm text-gray-400 ml-2">/ {{ isset($customer) ? 'modifier' : 'nouveau' }}</span>
@endsection

@section('content')
    <div class="max-w-lg">
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-800 mb-6">
                {{ isset($customer) ? 'Modifier le client' : 'Nouveau client' }}
            </h3>

            <form method="POST"
                  action="{{ isset($customer) ? route('customers.update', $customer) : route('customers.store') }}">
                @csrf
                @if(isset($customer)) @method('PUT') @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet</label>
                        <input type="text" name="name"
                               value="{{ old('name', $customer->name ?? '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="Nom complet">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email"
                               value="{{ old('email', $customer->email ?? '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="email@exemple.com">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input type="text" name="phone"
                               value="{{ old('phone', $customer->phone ?? '') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                               placeholder="+212 6XX XX XX XX">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                        <textarea name="address" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                  placeholder="Adresse complète">{{ old('address', $customer->address ?? '') }}</textarea>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-gray-100">
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition">
                        {{ isset($customer) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                    <a href="{{ route('customers.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection