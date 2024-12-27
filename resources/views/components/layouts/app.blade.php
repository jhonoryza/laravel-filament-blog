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
    @stack('css')

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

<body class="antialiased font-main max-w-sm mx-auto">
<div class="flex flex-col">
    <x-navigation/>

    <main class="py-4 mt-10">
        {{ $slot }}
    </main>
</div>

@filamentScripts
@vite('resources/js/app.js')
@stack('js')
</body>

</html>
