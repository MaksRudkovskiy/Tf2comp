@props(['name', 'id' => null, 'accept' => null, 'disabled' => false])

<input type="file"
       name="{{ $name }}"
       id="{{ $id ?? $name }}"
       @if($accept) accept="{{ $accept }}" @endif
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full text-sm text-custom-EBE3CB
            file:mr-4 file:py-2 file:px-4
            file:rounded file:border-tf
            file:text-sm file:bg-front file:text-custom-EBE3CB
            hover:file:bg-front/80']) }}>
