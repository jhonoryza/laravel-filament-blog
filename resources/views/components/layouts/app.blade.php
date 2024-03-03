<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {!! Meta::toHtml() !!}

    <link rel="icon" href="{{ asset('favicon.png') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="antialiased font-quicksand">
    <x-navigation />

    <main class="p-4">
        {{ $slot }}
    </main>

    @filamentScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>

</html>
