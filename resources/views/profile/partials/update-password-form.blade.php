<section class="max-w-2xl mx-auto bg-white border border-gray-100 shadow-xl rounded-2xl p-6 space-y-6">

    <!-- HEADER -->
    <div class="border-b pb-3">
        <h2 class="text-xl font-bold text-black">
            Sécurité du compte
        </h2>
        <p class="text-sm text-gray-500">
            Assure-toi que ton mot de passe est sécurisé
        </p>
    </div>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div>
            <label class="block text-sm font-medium text-black">Current Password</label>
            <input type="password"
                   name="current_password"
                   class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-xl 
                          focus:outline-none focus:ring-2 focus:ring-orange-500"
                   autocomplete="current-password">

            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-sm font-medium text-black">New Password</label>
            <input type="password"
                   name="password"
                   class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-xl 
                          focus:outline-none focus:ring-2 focus:ring-orange-500"
                   autocomplete="new-password">

            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-black">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="w-full mt-1 px-4 py-2 border border-gray-200 rounded-xl 
                          focus:outline-none focus:ring-2 focus:ring-orange-500"
                   autocomplete="new-password">
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center justify-between pt-4">

            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-black font-semibold px-6 py-2 rounded-xl transition">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-green-600 text-sm font-medium">
                    ✔ Updated successfully
                </span>
            @endif

        </div>

    </form>

</section>