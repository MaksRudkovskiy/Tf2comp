@props(['disabled' => false])

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-custom-danger border-tf rounded text-xs text-white uppercase tracking-widest hover:text-custom-text-hover']) }}>
    {{ $slot }}
</button>
