<x-mail::layout>
    <x-slot:header>
        Mon Marché
    </x-slot:header>

    {!! $slot !!}

    <x-slot:footer>
        © {{ date('Y') }} Mon Marché
    </x-slot:footer>
</x-mail::layout>