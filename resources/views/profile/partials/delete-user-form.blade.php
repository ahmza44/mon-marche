<section class="space-y-6">

    <header>
    
        <p class="text-sm text-gray-600">
            Once you delete your account, all data will be permanently removed.
            Please be sure before continuing.
        </p>
    </header>

    <!-- DELETE BUTTON -->
    <button type="button"
            onclick="document.getElementById('deleteModal').classList.remove('hidden')"
            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
        Delete Account
    </button>

    <!-- MODAL -->
    <div id="deleteModal"
         class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg">

            <h2 class="text-lg font-bold text-gray-800">
                Are you sure?
            </h2>

            <p class="text-sm text-gray-600 mt-2">
                This action cannot be undone. Enter your password to confirm deletion.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4 space-y-4">
                @csrf
                @method('DELETE')

                <!-- Password -->
                <div>
                    <input type="password"
                           name="password"
                           placeholder="Enter password"
                           class="w-full border rounded-lg p-2 focus:ring focus:ring-red-300">

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3">

                    <button type="button"
                            onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                        Cancel
                    </button>

                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Delete
                    </button>

                </div>

            </form>

        </div>
    </div>

</section>