@props(['name', 'id' => null, 'value' => '', 'required' => false, 'disabled' => false])

<textarea name="{{ $name }}"
          id="{{ $id ?? $name }}"
          @if($required) required @endif
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full border-tf bg-back rounded p-2 text-custom-EBE3CB font-tf2 placeholder-custom-EBE3CB']) }}
>{{ old($name, $value) }}</textarea>
