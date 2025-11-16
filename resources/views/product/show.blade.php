<x-layouts.main>
    <x-slot:title>{{ $product->title }} - Detalle del Producto</x-slot:title>

    {{-- Componente de detalle del producto --}}
    <x-item :product="$product" />
</x-layouts.main>
