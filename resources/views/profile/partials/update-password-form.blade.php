<section class="space-y-6">

    <header>
        
        <p class="text-sm text-gray-600">
            Ensure your account is using a strong password.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div>
            <label class="block text-sm font-medium">Current Password</label>
            <input type="password"
                   name="current_password"
                   class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-red-300"
                   autocomplete="current-password">

            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-sm font-medium">New Password</label>
            <input type="password"
                   name="password"
                   class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-red-300"
                   autocomplete="new-password">

            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-red-300"
                   autocomplete="new-password">

            @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-green-600 text-sm">
                    ✔ Saved successfully
                </span>
            @endif
        </div>

    </form>

</section>