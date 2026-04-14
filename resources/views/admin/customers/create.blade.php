@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4">

    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl border border-orange-100 p-8">

        <!-- HEADER -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Ajouter un client
            </h2>
            <p class="text-sm text-gray-500">
                Remplissez les informations du client
            </p>
        </div>

        <form method="POST" action="{{ route('customers.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LEFT -->
                <div class="space-y-5">

                    <div>
                        <label class="text-sm font-medium text-gray-600">Nom complet</label>
                        <input type="text" name="name"
                               class="w-full mt-1 px-4 py-3 border border-gray-200 rounded-xl
                                      focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               placeholder="Nom complet">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <input type="email" name="email"
                               class="w-full mt-1 px-4 py-3 border border-gray-200 rounded-xl
                                      focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               placeholder="email@exemple.com">
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="space-y-5">

                    <div>
                        <label class="text-sm font-medium text-gray-600">Téléphone</label>
                        <input type="text" name="phone"
                               class="w-full mt-1 px-4 py-3 border border-gray-200 rounded-xl
                                      focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                               placeholder="+212 6XX XX XX XX">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-600">Adresse</label>
                        <textarea name="address" rows="5"
                                  class="w-full mt-1 px-4 py-3 border border-gray-200 rounded-xl
                                         focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                                  placeholder="Adresse complète"></textarea>
                    </div>

                </div>

            </div>

            <!-- ACTIONS -->
            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('customers.index') }}"
                   class="px-5 py-2 text-gray-500 hover:text-gray-700">
                    Annuler
                </a>

                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-medium">
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</div>
@endsection