{{-- resources/views/components/product-grid.blade.php --}}

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
    2 => 'grid-cols-1 md:grid-cols-2',
    3 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
    4 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
    5 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5',
    6 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6',
    default => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
};
?>

<section class="product-grid-section rounded-2xl shadow-lg overflow-hidden mx-4 my-6">
    {{-- Título de la sección --}}
    <div class="bg-secondary-color/30 backdrop-blur-sm backdrop-saturate-150 border-b border-white/20 px-6 py-4">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 leading-tight">
            {{ $title }}
        </h2>
        @if ($subtitle)
            <p class="text-gray-600 mt-2">{{ $subtitle }}</p>
        @endif
    </div>

    {{-- Grid de productos --}}
    <div class="p-6">
        <div class="grid {{ $gridClasses }} gap-6">
            @forelse($product as $index => $item)
                <article
                    class="product-card bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer"
                    @if (isset($item->id)) onclick="window.location.href='{{ route('product.show', $item->id) }}'"
                    @else
                        onclick="alert('Producto de ejemplo - No disponible para compra')" @endif>
                    {{-- Imagen del producto --}}
                    <div class="relative overflow-hidden">
                        <img src="{{ $item['image'] ?? ($item->image ?? '/assets/images/placeholder-product.jpg') }}"
                            alt="{{ $item['name'] ?? ($item->title ?? 'Producto') }}"
                            class="w-full h-48 md:h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                            loading="lazy">

                        {{-- Overlay de hover --}}
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <span
                                class="opacity-0 group-hover:opacity-100 bg-white text-gray-800 px-4 py-2 rounded-lg font-medium transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                                Ver detalles
                            </span>
                        </div>
                    </div>

                    {{-- Contenido del producto --}}
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">
                            {{ $item['name'] ?? ($item->title ?? 'Título producto') }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                            {{ $item['description'] ?? ($item->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}
                        </p>

                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-gray-800">
                                ${{ number_format($item['price'] ?? ($item->price ?? 30000), 0, ',', '.') }}
                            </span>

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-sm"
                                onclick="event.stopPropagation();">
                                Agregar
                            </button>
                        </div>
                    </div>
                </article>
            @empty
                {{-- Estado vacío --}}
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">No hay productos disponibles</h3>
                    <p class="text-gray-500">Pronto tendremos productos increíbles para ti.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Botón "Ver más" --}}
    @if ($seeMoreUrl && count($product) > 0)
        <footer class="bg-secondary-color/30 backdrop-blur-sm backdrop-saturate-150 border-t border-white/20 px-6 py-4">
            <a href="{{ $seeMoreUrl }}"
                class="flex items-center justify-between text-red-600 hover:text-red-700 font-medium transition-colors duration-200 group">
                <span>{{ $seeMoreText }}</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </footer>
    @endif
</section>

<style>
    /* Estilos adicionales para line-clamp */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        line-clamp: 2;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        line-clamp: 3;
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación de entrada para las tarjetas de productos
        gsap.fromTo('.product-card', {
            opacity: 0,
            y: 30,
            scale: 0.95
        }, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.6,
            stagger: 0.1,
            ease: "power2.out"
        });

        // Animación de hover para las tarjetas
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    y: -5,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });

            card.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    y: 0,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        });

        // Animación del botón "Ver más"
        const seeMoreBtn = document.querySelector('.product-grid-section footer a');
        if (seeMoreBtn) {
            seeMoreBtn.addEventListener('mouseenter', function() {
                gsap.to(this.querySelector('svg'), {
                    x: 5,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            seeMoreBtn.addEventListener('mouseleave', function() {
                gsap.to(this.querySelector('svg'), {
                    x: 0,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        }
    });
</script>
