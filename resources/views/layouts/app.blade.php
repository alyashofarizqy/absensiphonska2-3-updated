<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }} - {{ $title ?? 'Home' }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- Meta Tags -->
    @stack('meta-tags')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="antialiased text-zinc-900 font-mona" x-cloak x-data="{ dark: $persist(false) }" :class="{ 'dark': dark === true }">
    <div class="min-h-screen bg-zinc-100 dark:bg-zinc-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-zinc-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Copy Right -->
    <footer class="w-full text-center  p-4 text-zinc-300 dark:text-zinc-700 bg-zinc-100 dark:bg-zinc-900">
        <p class="text-sm">
            &copy; {{ date('Y') }} {{ config('app.name', 'Phonska 2/3') }}
        </p>
    </footer>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
