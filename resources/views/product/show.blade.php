<x-layouts.main>
    <x-slot:title>{{ $product->title }} - Detalle del Producto</x-slot:title>

    {{-- Breadcrumbs --}}
    @php
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
            ['name' => 'Productos', 'url' => route('product.index'), 'active' => false],
            ['name' => $product->title, 'url' => '#', 'active' => true],
        ];
    @endphp

    {{-- Componente de detalle del producto --}}
    <x-item :product="$product" />
</x-layouts.main>
