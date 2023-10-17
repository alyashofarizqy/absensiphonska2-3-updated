@props(['icon', 'variant', 'label' => 'Icon', 'disabled' => false])

<x-button
    {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center justify-center relative h-9 w-9', 'variant' => $variant, 'disabled' => $disabled]) }}>
    <i class="absolute w-4 h-4 -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" data-lucide="{{ $icon }}"></i>
    <span class="sr-only">{{ $label }}</span>
</x-button>
