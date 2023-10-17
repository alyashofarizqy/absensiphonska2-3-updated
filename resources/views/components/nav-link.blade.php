@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white dark:border-phonska-600 text-sm font-medium leading-5 text-white dark:text-zinc-100 focus:outline-none focus:border-white transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-zinc-400 dark:text-zinc-400 hover:text-zinc-100 dark:hover:text-zinc-300 hover:border-zinc-300 dark:hover:border-zinc-700 focus:outline-none focus:text-zinc-100 dark:focus:text-zinc-300 focus:border-zinc-300 dark:focus:border-zinc-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
