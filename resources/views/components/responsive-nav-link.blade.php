@props(['active'])

@php
    $classes = $active ?? false ? 'text-sm block w-full px-4 py-2 font-medium text-zinc-900 dark:text-zinc-900 bg-zinc-50 dark:bg-zinc-50 focus:outline-none focus:text-zinc-900 dark:focus:text-zinc-50 focus:bg-zinc-50 dark:focus:bg-zinc-50 transition duration-150 ease-in-out' : 'text-sm block w-full px-4 py-2 font-medium text-zinc-100/60 dark:text-zinc-400 hover:text-zinc-50 dark:hover:text-zinc-200 hover:bg-zinc-100/10 dark:hover:bg-zinc-700 hover:border-zinc-300 dark:hover:border-zinc-600 focus:outline-none focus:text-zinc-800 dark:focus:text-zinc-200 focus:bg-zinc-50 dark:focus:bg-zinc-700 focus:border-zinc-300 dark:focus:border-zinc-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
