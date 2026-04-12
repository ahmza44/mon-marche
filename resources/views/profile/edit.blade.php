@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-10 space-y-6">

    <!-- Profile Information -->
    <div class="p-6 bg-white rounded-xl shadow">
        <h2 class="text-lg font-bold mb-4">Profile Information</h2>

        @include('profile.partials.update-profile-information-form')
    </div>

   

</div>

@endsection