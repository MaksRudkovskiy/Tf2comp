<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-1.5 text-md bg-front rounded border-tf hover:text-custom-text-hover']) }}>
    {{ $slot }}
</button>
