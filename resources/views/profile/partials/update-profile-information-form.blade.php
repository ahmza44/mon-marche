<section class="max-w-3xl mx-auto space-y-8">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
            ✔ {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-xl font-bold text-black">
            Profile Settings
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Update your account information and avatar
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-6">

        @csrf
        @method('PATCH')

        {{-- AVATAR --}}
        <div class="flex items-center gap-6">

          @php
    $user = auth('customer')->user();
@endphp

<img src="{{ $user && $user->avatar
        ? (str_starts_with($user->avatar, 'http')
            ? $user->avatar
            : asset('storage/' . $user->avatar))
        : asset('storage/avatars/default.png') }}"
     class="w-16 h-16 rounded-full object-cover border-2 border-orange-500">

            <div class="flex-1">
                <label class="block text-sm font-medium text-black mb-1">
                    Avatar
                </label>

                <input type="file"
                       name="avatar"
                       class="w-full text-sm border border-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
            </div>
        </div>

        {{-- NAME --}}
        <div>
            <label class="block text-sm font-medium text-black mb-1">
                Name
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name', auth()->user()->name) }}"
                   class="w-full border border-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                   required>
        </div>

        {{-- EMAIL --}}
        <div>
            <label class="block text-sm font-medium text-black mb-1">
                Email
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email', auth()->user()->email) }}"
                   class="w-full border border-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                   required>
        </div>

        {{-- BUTTON --}}
        <div class="flex items-center justify-between pt-4">

            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                Save Changes
            </button>

            @if(session('success'))
                <span class="text-green-600 text-sm font-medium">
                    ✔ Saved successfully
                </span>
            @endif

        </div>

    </form>

</section>