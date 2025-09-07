<x-layouts.main>
    {{-- Ejemplo de uso del componente ProductGrid --}}
    <section class="max-w-7xl mx-auto">
        <x-product-grid
            :products="[
                [
                    'name' => 'Juego de Comunicación',
                    'description' => 'Tablero educativo para mejorar la comunicación y el lenguaje en niños. Incluye actividades interactivas y materiales didácticos.',
                    'price' => 30000,
                    'image' => '/assets/images/producto-1.jpg'
                ],
                [
                    'name' => 'Kit de Lectura',
                    'description' => 'Conjunto completo de herramientas para desarrollar habilidades de lectura y comprensión lectora.',
                    'price' => 25000,
                    'image' => '/assets/images/producto-2.jpg'
                ],
                [
                    'name' => 'Material Didáctico',
                    'description' => 'Recursos educativos diseñados para estimular el aprendizaje y la creatividad en el aula.',
                    'price' => 35000,
                    'image' => '/assets/images/producto-3.jpg'
                ],
                [
                    'name' => 'Juego Interactivo',
                    'description' => 'Actividad lúdica que combina diversión y aprendizaje para niños de todas las edades.',
                    'price' => 28000,
                    'image' => '/assets/images/producto-4.jpg'
                ]
            ]"
            title="Comunicación y lenguaje"
            subtitle="Productos educativos para el desarrollo del lenguaje"
            see-more-url="{{ route('products.index') }}"
            see-more-text="Ver más"
            :columns="4" />


                <x-product-grid
            :products="[
                [
                    'name' => 'Juego de Comunicación',
                    'description' => 'Tablero educativo para mejorar la comunicación y el lenguaje en niños. Incluye actividades interactivas y materiales didácticos.',
                    'price' => 30000,
                    'image' => '/assets/images/producto-1.jpg'
                ],
                [
                    'name' => 'Kit de Lectura',
                    'description' => 'Conjunto completo de herramientas para desarrollar habilidades de lectura y comprensión lectora.',
                    'price' => 25000,
                    'image' => '/assets/images/producto-2.jpg'
                ],
                [
                    'name' => 'Material Didáctico',
                    'description' => 'Recursos educativos diseñados para estimular el aprendizaje y la creatividad en el aula.',
                    'price' => 35000,
                    'image' => '/assets/images/producto-3.jpg'
                ],
                [
                    'name' => 'Juego Interactivo',
                    'description' => 'Actividad lúdica que combina diversión y aprendizaje para niños de todas las edades.',
                    'price' => 28000,
                    'image' => '/assets/images/producto-4.jpg'
                ]
            ]"
            title="Comunicación y lenguaje"
            subtitle="Productos educativos para el desarrollo del lenguaje"
            see-more-url="{{ route('products.index') }}"
            see-more-text="Ver más"
            :columns="4" />
    </section>

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