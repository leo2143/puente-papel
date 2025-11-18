<x-layouts.main>
    <x-slot:title>Inicio</x-slot:title>

    <x-image-slides />
    
    {{-- Productos Destacados --}}
    @if ($featuredProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$featuredProducts" title="Productos Destacados"
                subtitle="Nuestros productos más populares y recomendados" see-more-url="{{ route('product.index') }}"
                see-more-text="Ver todos los productos" :columns="4" />
        </section>
    @endif

    {{-- Productos de Comunicación --}}
    @if ($communicationProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$communicationProducts" title="Comunicación y Lenguaje"
                subtitle="Productos educativos para el desarrollo del lenguaje y la comunicación"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más de comunicación" :columns="2" />
        </section>
    @endif

    {{-- Productos de Lectura --}}
    @if ($readingProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$readingProducts" title="Lectura y Comprensión"
                subtitle="Recursos para fomentar el amor por la lectura y mejorar la comprensión"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más de lectura" :columns="4" />
        </section>
    @endif

    {{-- Productos de Matemáticas --}}
    @if ($mathProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$mathProducts" title="Matemáticas"
                subtitle="Herramientas para hacer las matemáticas divertidas y comprensibles"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más de matemáticas" :columns="2" />
        </section>
    @endif

    {{-- Productos de Ciencias --}}
    @if ($scienceProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$scienceProducts" title="Ciencias"
                subtitle="Explora el mundo de las ciencias de manera interactiva y educativa"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más de ciencias" :columns="4" />
        </section>
    @endif

    {{-- Fallback: Si no hay productos, mostrar mensaje --}}
    @if (
        $featuredProducts->count() == 0 &&
            $communicationProducts->count() == 0 &&
            $readingProducts->count() == 0 &&
            $mathProducts->count() == 0 &&
            $scienceProducts->count() == 0)
        <section class="max-w-7xl mx-auto">
            <div class="bg-pink-50 px-8 py-16 rounded-2xl border-2 border-pink-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Próximamente</h2>
                <p class="text-gray-600">Estamos preparando productos increíbles para ti.</p>
            </div>
        </section>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada rápida y sutil
            gsap.fromTo('.product-grid-section', {
                opacity: 0,
                y: 10
            }, {
                opacity: 1,
                y: 0,
                duration: 0.2,
                ease: "power2.out"
            });
        });
    </script>
</x-layouts.main>
