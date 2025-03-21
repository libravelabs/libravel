@props([
    'nav' => true,
    'bg' => 'bg-light-bg-primary dark:bg-dark-bg-primary',
])
@php
    $nav = $nav ?? true;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') {{ SettingsHelper::getInfos('fullname') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />

    @stack('styles')
    @livewireStyles()
    @filamentStyles()
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="{{ $bg }} text-light-text-primary dark:text-dark-text-primary scroll-smooth font-geist-sans">

    @if ($nav)
        @include('layouts.navbar')

        <main class="py-16 md:py-28">
            @yield('content')
        </main>

        <footer class="flex justify-center py-8">
            @include('layouts.footer')
        </footer>
    @else
        @yield('content')
    @endif

    <x-toaster-hub />

    @filamentScripts()
    @livewireScripts()
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-href]').forEach(button => {
                button.addEventListener('click', () => {
                    const href = button.getAttribute('data-href');
                    const target = button.getAttribute('data-target') || '_self';
                    if (href) {
                        window.open(href, target, 'noopener,noreferrer');
                    }
                });
            });
        });
    </script>
</body>

</html>
