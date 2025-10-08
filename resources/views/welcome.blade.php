<x-layouts.main>
    {{-- Hero Section --}}
    <section class="bg-pink-50 px-4 py-8 rounded-2xl max-w-6xl mx-auto mb-12 mt-8 text-center border-2 border-pink-200">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Bienvenido a Puente Papel</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Descubre nuestra amplia gama de productos educativos diseñados para el desarrollo integral de los niños
        </p>
    </section>

    {{-- Productos Destacados --}}
    @if ($featuredProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$featuredProducts" title="Productos Destacados"
                subtitle="Nuestros productos más populares y recomendados"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver todos los productos" :columns="4" />
        </section>
    @endif

    {{-- Productos de Comunicación --}}
    @if ($communicationProducts->count() > 0)
        <section class="max-w-7xl mx-auto mb-12">
            <x-product-grid :product="$communicationProducts" title="Comunicación y Lenguaje"
                subtitle="Productos educativos para el desarrollo del lenguaje y la comunicación"
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más de comunicación" :columns="4" />
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
                see-more-url="{{ route('product.index') }}" see-more-text="Ver más de matemáticas" :columns="4" />
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
    @if ($featuredProducts->count() == 0 && $communicationProducts->count() == 0 && $readingProducts->count() == 0 && $mathProducts->count() == 0 && $scienceProducts->count() == 0)
        <section class="max-w-7xl mx-auto">
            <div class="bg-pink-50 px-8 py-16 rounded-2xl text-center border-2 border-pink-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Próximamente</h2>
                <p class="text-gray-600">Estamos preparando productos increíbles para ti.</p>
            </div>
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
