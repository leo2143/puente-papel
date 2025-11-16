{{-- resources/views/components/product-grid.blade.php -- }}
{{-- columns-3xl --}}
<?php
// Datos del componente con valores por defecto
$product = $product ?? [];
$title = $title ?? 'Productos';
$subtitle = $subtitle ?? null;
$seeMoreUrl = $seeMoreUrl ?? null;
$seeMoreText = $seeMoreText ?? 'Ver más';
$columns = $columns ?? 4;

// Generar clases del grid
$gridClasses = match ($columns) {
    2 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 ',
    4 => 'grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 ',
    default => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
};

// Valores comunes para ambas configuraciones
$contentClasses = 'flex-1 flex flex-col justify-between';
$imageClasses = 'w-full h-full max-w-[200px] max-h-[200px] xl:max-w-none xl:max-h-none rounded-lg  object-cover object-center';

if ($columns === 2) {
    $articleFlexClasses = 'flex flex-row md:flex-col md:flex items-center md:py-3 md:px-3';
    $imageContainerClasses = 'flex-shrink-0';
    $contentClasses .= ' p-4 md:py-4 md:px-0';
} else {
    $contentClasses .= ' py-4';
    $articleFlexClasses = 'flex flex-col py-3 px-3';
    $imageContainerClasses = 'flex items-center justify-center flex-shrink-0';
}

?>

<section class="product-grid-section rounded-2xl shadow-lg overflow-hidden mx-4 my-6">
    {{-- Título de la sección --}}
    <div class="bg-white px-8 py-6 border-2 border-pink-200 flex flex-row justify-between">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight text-left ">
            {{ $title }}
        </h2>
        @if ($seeMoreUrl && count($product) > 0)
            <a href="{{ $seeMoreUrl }}" class="hidden md:flex items-center justify-between text-red-600 font-semibold">
                <span>{{ $seeMoreText }}</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @endif
    </div>

    {{-- Grid de productos --}}
    <div class="">
        <div class="grid {{ $gridClasses }} ">

            @forelse($product as $index => $item)
                <article
                    class="product-card bg-white shadow-md overflow-hidden group cursor-pointer border-2 border-pink-200 {{ $articleFlexClasses }}"
                    @if (isset($item->id)) onclick="window.location.href='{{ route('product.show', $item->id) }}'"
          @else
            onclick="alert('Producto de ejemplo - No disponible para compra')" @endif>
                    {{-- Imagen del producto --}}

                    <div class="relative overflow-hidden {{ $imageContainerClasses }}">
                        @if (isset($item->image_url) && $item->image_url)
                            <img src="{{ $item->image_url }}" alt="{{ $item->name ?? ($item->title ?? 'Producto') }}"
                                class="{{ $imageClasses }}" loading="lazy">
                        @else
                            <div
                                class="{{ $imageClasses }} bg-pink-100 flex items-center justify-center border-2 border-pink-300">
                                <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Contenido del producto --}}
                    <div class=" {{ $contentClasses }}">
                        <div>
                            <h3
                                class="text-lg text-gray-800 mb-2 {{ $columns === 2 ? '' : 'line-clamp-2' }} group-hover:text-red-600">
                                {{ $item->name ?? ($item->title ?? 'Título producto') }}
                            </h3>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-800">
                                ${{ number_format($item->price ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </article>
            @empty
                {{-- Estado vacío --}}
                <div class="col-span-full bg-pink-50 px-8 py-12 rounded-2xl border-2 border-pink-200">
                    <div class="text-pink-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2 text-center">No hay productos disponibles</h3>
                    <p class="text-gray-600">Pronto tendremos productos increíbles para ti.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Botón "Ver más" --}}
    @if ($seeMoreUrl && count($product) > 0)
        <div class="bg-pink-50 px-8 py-6 border-t-2 border-pink-200 md:hidden">
            <a href="{{ $seeMoreUrl }}" class="flex items-center justify-between text-red-600 font-semibold">
                <span>{{ $seeMoreText }}</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    @endif
</section>

<style>

</style>
