<x-layouts.main>

<div class="max-w-4xl mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Sobre Puente Papel</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Conectamos el aprendizaje con la diversión a través de materiales educativos innovadores
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Nuestra Misión</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    En Puente Papel creemos que el aprendizaje debe ser accesible, divertido y efectivo. 
                    Desarrollamos materiales educativos especializados que facilitan la comunicación 
                    y el desarrollo del lenguaje en niños y niñas.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Nuestros productos están diseñados con pictogramas y herramientas visuales 
                    que hacen que el aprendizaje sea más intuitivo y atractivo para todos.
                </p>
            </div>
            <div class="bg-gradient-to-br from-pink-100 to-red-100 rounded-2xl p-8">
                <div class="text-center">
                    <div class="w-24 h-24 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Educación Inclusiva</h3>
                    <p class="text-gray-600">Materiales diseñados para todos los niños</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Calidad</h3>
                <p class="text-gray-600">Materiales de alta calidad diseñados por expertos en educación</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Creatividad</h3>
                <p class="text-gray-600">Soluciones innovadoras que hacen el aprendizaje más divertido</p>
            </div>
            <div class="text-center">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Empatía</h3>
                <p class="text-gray-600">Entendemos las necesidades únicas de cada niño y familia</p>
            </div>
        </div>

        <div class="bg-gray-50 rounded-2xl p-8 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">¿Listo para comenzar?</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Explora nuestros productos educativos y descubre cómo podemos ayudarte 
                a crear un puente hacia el aprendizaje efectivo.
            </p>
            <a href="{{ route('product.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors duration-200">
                Ver Productos
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

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
