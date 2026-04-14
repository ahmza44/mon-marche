<x-mail::message>

{{-- HEADER BRAND --}}
# 🛒 Mon Marché

@if (!empty($greeting))
### {{ $greeting }}
@else
### Bonjour 👋
@endif

---

{{-- INTRO --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

---

{{-- BUTTON --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success' => 'success',
        'error' => 'error',
        default => 'primary',
    };
?>

<x-mail::button :url="$actionUrl" :color="$color">
🔐 {{ $actionText }}
</x-mail::button>
@endisset

---

{{-- OUTRO --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

---

{{-- SIGNATURE --}}
@if (!empty($salutation))
{{ $salutation }}
@else
Merci,<br>
<strong>Mon Marché Team 🛒</strong>
@endif

---

{{-- FOOTER --}}
<x-slot:subcopy>
Si vous avez des problèmes avec le bouton, copiez et collez ce lien dans votre navigateur :
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>

</x-mail::message>