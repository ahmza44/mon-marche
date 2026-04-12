<section class="space-y-6">

    <header>
        <p class="text-sm text-gray-600">
            Update your account information and email address.
        </p>
    </header>

    <!-- Send verification -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- UPDATE PROFILE -->
    <form method="POST"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="space-y-5">

        @csrf
        @method('PATCH')

        <!-- AVATAR -->
        <div>
            <label class="block text-sm font-medium">Avatar</label>

            <input type="file"
                   name="avatar"
                   class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-red-300">

            <!-- preview -->
           <div class="mt-3">
    <img src="{{ auth()->user()->avatar 
        ? asset('storage/'.auth()->user()->avatar)
        : asset('storage/avatars/default.png') }}"
        class="w-10 h-10 rounded-full object-cover">
</div>
                
            </div>
        </div>

        <!-- NAME -->
        <div>
            <label class="block text-sm font-medium">Name</label>

            <input type="text"
                   name="name"
                   value="{{ old('name', auth()->user()->name) }}"
                   class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-red-300"
                   required>

            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- EMAIL -->
        <div>
            <label class="block text-sm font-medium">Email</label>

            <input type="email"
                   name="email"
                   value="{{ old('email', auth()->user()->email) }}"
                   class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-red-300"
                   required>

            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- Verification -->
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-3 text-sm text-gray-600">

                    <p>Your email is not verified.</p>

                    <button form="send-verification"
                            class="underline text-red-600 hover:text-red-800">
                        Resend verification email
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-green-600 mt-1">
                            Verification link sent!
                        </p>
                    @endif

                </div>
            @endif
        </div>

        <!-- SAVE -->
        <div class="flex items-center gap-4">

            <button type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                Save
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-green-600 text-sm">
                    ✔ Saved successfully
                </span>
            @endif

        </div>

    </form>

</section>