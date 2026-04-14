<section class="space-y-6">

    {{-- TITLE --}}
    <header>
        <h2 class="text-lg font-bold text-gray-900">
            Suppression du compte
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Une fois votre compte supprimé, toutes vos données seront définitivement effacées.
            Cette action est irréversible.
        </p>
    </header>

    {{-- DELETE BUTTON --}}
    <button type="button"
            onclick="document.getElementById('deleteModal').classList.remove('hidden')"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl
                   bg-orange-500 text-white font-semibold text-sm
                   hover:bg-orange-600 transition shadow-md">

        <i data-lucide="trash-2" class="w-4 h-4"></i>
        Supprimer le compte
    </button>

    {{-- MODAL --}}
    <div id="deleteModal"
         class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 px-4">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border border-orange-100">

            {{-- HEADER --}}
            <div class="p-5 border-b border-orange-100 bg-orange-50">
                <h3 class="text-lg font-bold text-gray-900">
                    Confirmation
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Entrez votre mot de passe pour confirmer la suppression.
                </p>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ route('profile.destroy') }}" class="p-5 space-y-4">
                @csrf
                @method('DELETE')

                {{-- PASSWORD --}}
                <div>
                    <label class="text-sm font-medium text-gray-700">
                        Mot de passe
                    </label>

                    <input type="password"
                           name="password"
                           placeholder="••••••••"
                           class="w-full mt-1 px-4 py-3 rounded-xl border border-gray-200
                                  focus:border-orange-500 focus:ring-2 focus:ring-orange-100
                                  outline-none transition">

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTIONS --}}
                <div class="flex justify-end gap-3 pt-2">

                    <button type="button"
                            onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700
                                   hover:bg-gray-200 transition text-sm font-medium">
                        Annuler
                    </button>

                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-orange-500 text-white
                                   hover:bg-orange-600 transition text-sm font-semibold shadow-md">
                        Confirmer
                    </button>

                </div>

            </form>

        </div>
    </div>

</section>