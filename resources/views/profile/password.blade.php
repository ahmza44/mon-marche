@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-10">

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-bold mb-4">Change Password</h2>
        @include('profile.partials.update-password-form')
    </div>

</div>

@endsection