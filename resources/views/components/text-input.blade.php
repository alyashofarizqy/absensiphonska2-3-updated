@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-secondary-200 dark:focus:border-zinc-600 focus:ring-secondary-300 dark:focus:ring-zinc-600 rounded-lg shadow-sm',
]) !!}>
