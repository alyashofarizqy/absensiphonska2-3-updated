@props(['variant' => 'primary', 'type' => 'button', 'disabled' => false])

@php
    switch ($variant) {
        case 'primary':
            $variantClasses = 'bg-secondary-200 dark:bg-zinc-200 border border-transparent text-zinc-900 dark:text-zinc-800 hover:bg-secondary-300 dark:hover:bg-zinc-100 focus:bg-secondary-300 dark:focus:bg-zinc-100 active:bg-secondary-300 dark:active:bg-zinc-100 focus:ring-2 focus:ring-secondary-200 focus:ring-offset-2 dark:focus:ring-offset-zinc-800';
            break;
        case 'secondary':
            $variantClasses = 'bg-zinc-200 dark:bg-zinc-800 border border-transparent text-zinc-900 dark:text-zinc-100 hover:bg-secondary-200 dark:hover:bg-zinc-700 focus:bg-secondary-200 dark:focus:bg-zinc-700 active:bg-secondary-200 dark:active:bg-zinc-700 focus:ring-2 focus:ring-secondary-200 focus:ring-offset-2 dark:focus:ring-offset-zinc-800';
            break;
        case 'outline':
            $variantClasses = 'border border-secondary-200 dark:border-secondary-200 text-zinc-900 dark:text-zinc-100 hover:text-zinc-900 hover:bg-secondary-200 dark:hover:bg-zinc-100 dark:hover:text-zinc-900 focus:bg-secondary-200 focus:text-zinc-900 dark:focus:bg-zinc-100 dark:focus:text-zinc-900 active:bg-secondary-200 active:text-zinc-900 dark:active:bg-zinc-100 dark:actve:text-zinc-900 focus:ring-2 focus:ring-secondary-200 focus:ring-offset-2 dark:focus:ring-offset-zinc-800';
            break;
        case 'danger':
            $variantClasses = 'bg-red-600 border border-transparent text-zinc-100 hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800';
            break;
    }
@endphp

<button
    {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150 ' . $variantClasses]) }}>
    {{ $slot }}
</button>
