<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<x-header />

<body class="antialiased font-main max-w-sm mx-auto">
    <div class="flex flex-col justify-start min-h-screen">
        <x-navigation/>

        <main class="py-4 px-1 mt-10">
            {{ $slot }}
        </main>

        <x-footer />
    </div>
    @filamentScripts
    @stack('js')
</body>

</html>
