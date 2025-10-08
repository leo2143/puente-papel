@props([
    'name' => 'image',
    'required' => false,
    'accept' => 'image/*',
    'class' => ''
])

@php
    $inputId = 'image-upload-' . uniqid();
@endphp

<div class="image-upload-container {{ $class }}">
    {{-- Input file oculto --}}
    <input 
        type="file" 
        id="{{ $inputId }}"
        name="{{ $name }}"
        class="hidden"
        accept="{{ $accept }}"
        {{ $required ? 'required' : '' }}
    >

    {{-- Botón de upload --}}
    <label for="{{ $inputId }}" class="image-upload-button">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
        </svg>
        Haz clic para subir
    </label>
</div>
