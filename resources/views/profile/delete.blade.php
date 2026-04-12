@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-10">

    <div class="bg-white p-6 rounded-xl shadow border border-red-200">
        <h2 class="text-lg font-bold mb-4 text-red-600">Delete Account</h2>
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection