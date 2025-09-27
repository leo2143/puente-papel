<x-layouts.main>
    {{-- Productos destacados desde la base de datos --}}
    @if ($featuredProducts->count() > 0)
        <section class="max-w-7xl mx-auto">
            <x-product-grid :product="$featuredProducts" title="Productos Destacados" subtitle="Nuestros productos más populares"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver todos los productos" :columns="4" />
        </section>
    @endif

    {{-- Productos de comunicación --}}
    @if ($communicationProducts->count() > 0)
        <section class="max-w-7xl mx-auto">
            <x-product-grid :product="$communicationProducts" title="Comunicación y lenguaje"
                subtitle="Productos educativos para el desarrollo del lenguaje"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más" :columns="4" />
        </section>
    @endif

    {{-- Productos de lectura --}}
    @if ($readingProducts->count() > 0)
        <section class="max-w-7xl mx-auto">
            <x-product-grid :product="$readingProducts" title="Lectura y comprensión"
                subtitle="Herramientas para mejorar la lectura" see-more-url="{{ route('product.index') }}"
                see-more-text="Ver más" :columns="4" />
        </section>
    @endif

    {{-- Fallback: Si no hay productos, mostrar mensaje --}}
    @if ($featuredProducts->count() == 0 && $communicationProducts->count() == 0 && $readingProducts->count() == 0)
        <section class="max-w-7xl mx-auto text-center py-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Próximamente</h2>
            <p class="text-gray-600">Estamos preparando productos increíbles para ti.</p>
        </section>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada para la sección completa
            gsap.fromTo('.product-grid-section', {
                opacity: 0,
                y: 50
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: "power2.out"
            });
        });
    </script>
</x-layouts.main>
