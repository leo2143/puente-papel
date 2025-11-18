@props([
    'name' => 'image',
    'required' => false,
    'accept' => 'image/*',
    'class' => '',
])

@php
    $inputId = 'image-upload-' . uniqid();
@endphp

<div class="image-upload-container {{ $class }}">
    {{-- Input file oculto --}}
    <input type="file" id="{{ $inputId }}" name="{{ $name }}" class="hidden" accept="{{ $accept }}"
        {{ $required ? 'required' : '' }}>

    {{-- Botón de upload --}}
    <label for="{{ $inputId }}" class="image-upload-button">
        <img src="{{ asset('storage/icons-svg/upload.svg') }}" alt="Subir archivo" title="Subir archivo"
            class="w-5 h-5 mr-2">
        Haz clic para subir
    </label>
</div>
