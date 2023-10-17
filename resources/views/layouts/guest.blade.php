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

    <!-- Background Image -->
    <img src="{{ url('assets/hero.jpeg') }}" alt="Hero Image" class="absolute object-cover w-screen h-screen -z-50" />
    <div class="absolute w-screen h-screen bg-black/70 -z-40"></div>

    <!-- Application Logo and Theme Toggle -->
    <div class="absolute top-0 w-full flex justify-between items-center p-4">
        <a href="{{ route('landing') }}">
            <x-application-logo class="font-bold text-zinc-100 text-lg" />
        </a>
    </div>

    <!-- Main Section -->
    <main class="container flex flex-col items-center justify-center min-h-screen mx-auto">
        {{ $slot }}
    </main>

    <!-- Copy Right -->
    <footer class="absolute bottom-0 w-full text-center text-zinc-100 p-4">
        <p class="text-sm">
            &copy; {{ date('Y') }} {{ config('app.name', 'Phonska 2/3') }}
        </p>
    </footer>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
