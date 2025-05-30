@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-tf bg-back font-tf2 rounded-md shadow-sm']) }}>
