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

    @if (config('app.env') == 'production')
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-6L3N891QWX"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-6L3N891QWX');
        </script>
    @endif
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
