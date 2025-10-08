@props(['product' => null])

<?php
// Verificar que el producto existe
if (!$product) {
    // Datos por defecto si no se pasa el producto
    $productData = [
        'id' => 1,
        'title' => 'Producto de ejemplo',
        'price' => 30000,
        'author' => 'Autor no especificado',
        'language' => 'Español',
        'publisher' => 'Puente Papel',
        'description' => 'Descripción no disponible',
        'images' => ['https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Imagen+1', 'https://via.placeholder.com/400x500/4ECDC4/FFFFFF?text=Imagen+2', 'https://via.placeholder.com/400x500/45B7D1/FFFFFF?text=Imagen+3', 'https://via.placeholder.com/400x500/96CEB4/FFFFFF?text=Imagen+4'],
        'quantity' => 1,
    ];
} else {
    // Datos del producto desde la base de datos
    $productData = [
        'id' => $product->id,
        'title' => $product->title,
        'price' => $product->price ?? 0,
        'author' => $product->author ?? 'Autor no especificado',
        'language' => $product->language ?? 'Español',
        'publisher' => $product->publisher ?? 'Puente Papel',
        'description' => $product->description ?? 'Descripción no disponible',
        'images' => $product->image_url ? [$product->image_url] : ['https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Sin+Imagen'],
        'quantity' => 1,
    ];
}

$currentImageIndex = 0;
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-pink-50 rounded-2xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">

            {{-- Sección de Imágenes --}}
            <div class="relative">
                <div class="relative overflow-hidden rounded-lg bg-gray-100">
                    {{-- Contenedor de imágenes --}}
                    <div id="image-container" class="relative h-96 lg:h-[500px]">
                        @foreach ($productData['images'] as $index => $image)
                            <div
                                class="image-slide absolute inset-0 transition-all duration-500 ease-in-out {{ $index === 0 ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}">
                                <img src="{{ $image }}"
                                    alt="{{ $productData['title'] }} - Imagen {{ $index + 1 }}"
                                    class="w-full h-full object-cover">

                                {{-- Overlay de texto (como en la imagen original) --}}
                                @if ($index === 0)
                                    <div class="absolute top-4 left-4 right-4">
                                        <div class="bg-orange-500 text-white px-4 py-2 rounded-lg text-center">
                                            <p class="text-sm font-semibold">6 EFEMERIDES ESCOLARES</p>
                                            <p class="text-xs">NARRADAS CON PICTOGRAMAS</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Flechas de navegación --}}
                    <button id="prev-btn"
                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-300 z-10">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    <button id="next-btn"
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-80 hover:bg-opacity-100 rounded-full p-2 shadow-lg transition-all duration-300 z-10">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>

                    {{-- Indicadores de imagen --}}
                    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        @foreach ($productData['images'] as $index => $image)
                            <button
                                class="image-indicator w-3 h-3 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white bg-opacity-50' }} transition-all duration-300"
                                data-index="{{ $index }}"></button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Sección de Información del Producto --}}
            <div class="space-y-6">
                {{-- Título y Precio --}}
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        {{ $productData['title'] ?? 'Título del producto' }}</h1>
                    <p class="text-2xl font-semibold text-red-600">
                        ${{ number_format($productData['price'], 0, ',', '.') }}</p>
                    <a href="#" class="text-red-600 text-sm hover:underline">Ver medios de pagos</a>
                </div>

                {{-- Selector de Cantidad --}}
                <div class="flex items-center space-x-4">
                    <label for="quantity" class="text-gray-700 font-medium">Cantidad:</label>
                    <div class="relative">
                        <select id="quantity"
                            class="appearance-none bg-pink-100 border-2 border-pink-300 rounded-xl px-4 py-2 pr-8 text-gray-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-300">
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}"
                                    {{ $i === $productData['quantity'] ? 'selected' : '' }}>{{ $i }}
                                </option>
                            @endfor
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción --}}
                <div class="space-y-3">
                    <button
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg">
                        Comprar ahora
                    </button>
                    <button
                        class="w-full bg-pink-100 hover:bg-pink-200 text-gray-800 font-semibold py-3 px-6 rounded-xl transition-all duration-300 border-2 border-pink-300 hover:shadow-lg">
                        Añadir al carrito
                    </button>
                </div>

                {{-- Características del Producto --}}
                <div class="bg-pink-100 rounded-xl p-4 border-2 border-pink-300">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Características</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Título del libro:</span>
                            <span class="font-medium">{{ $productData['title'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Autor:</span>
                            <span class="font-medium">{{ $productData['author'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Idioma:</span>
                            <span class="font-medium">{{ $productData['language'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Editorial del libro:</span>
                            <span class="font-medium">{{ $productData['publisher'] }}</span>
                        </div>
                    </div>
                </div>

                {{-- Descripción --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Descripción</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $productData['description'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = <?php echo json_encode($productData['images']); ?>;
        let currentIndex = 0;

        const imageContainer = document.getElementById('image-container');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const indicators = document.querySelectorAll('.image-indicator');
        const slides = document.querySelectorAll('.image-slide');

        // Función para actualizar la imagen actual
        function updateImage(index) {
            // Ocultar todas las imágenes
            slides.forEach((slide, i) => {
                if (i === index) {
                    gsap.to(slide, {
                        opacity: 1,
                        x: 0,
                        duration: 0.5,
                        ease: "power2.out"
                    });
                } else {
                    gsap.to(slide, {
                        opacity: 0,
                        x: i < index ? -100 : 100,
                        duration: 0.5,
                        ease: "power2.out"
                    });
                }
            });

            // Actualizar indicadores
            indicators.forEach((indicator, i) => {
                if (i === index) {
                    gsap.to(indicator, {
                        backgroundColor: '#ffffff',
                        scale: 1.2,
                        duration: 0.3
                    });
                } else {
                    gsap.to(indicator, {
                        backgroundColor: 'rgba(255, 255, 255, 0.5)',
                        scale: 1,
                        duration: 0.3
                    });
                }
            });
        }

        // Función para ir a la siguiente imagen
        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            updateImage(currentIndex);
        }

        // Función para ir a la imagen anterior
        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateImage(currentIndex);
        }

        // Event listeners para las flechas
        nextBtn.addEventListener('click', function() {
            gsap.to(this, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });
            nextImage();
        });

        prevBtn.addEventListener('click', function() {
            gsap.to(this, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });
            prevImage();
        });

        // Event listeners para los indicadores
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                currentIndex = index;
                updateImage(currentIndex);
            });
        });

        // Animación de entrada para el componente
        gsap.fromTo('.bg-pink-50', {
            opacity: 0,
            y: 50
        }, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out"
        });

        // Animación de entrada para las imágenes
        gsap.fromTo('.image-slide', {
            scale: 0.9,
            opacity: 0
        }, {
            scale: 1,
            opacity: 1,
            duration: 0.6,
            ease: "power2.out",
            stagger: 0.1
        });

        // Animación de entrada para la información del producto
        gsap.fromTo('.space-y-6 > *', {
            opacity: 0,
            x: 30
        }, {
            opacity: 1,
            x: 0,
            duration: 0.6,
            ease: "power2.out",
            stagger: 0.1,
            delay: 0.3
        });

        // Efectos hover para los botones
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.05,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            button.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        });

        // Auto-slide opcional (descomenta si quieres que cambie automáticamente)
        // setInterval(nextImage, 5000);
    });
</script>

<style>
    /* Estilos adicionales para mejorar la experiencia */
    .image-slide {
        will-change: transform, opacity;
    }

    .image-indicator {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .image-indicator:hover {
        transform: scale(1.3);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .grid {
            gap: 1rem;
        }

        .space-y-6 {
            padding: 1rem 0;
        }

        .text-3xl {
            font-size: 1.875rem;
        }

        .text-2xl {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 640px) {
        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-8 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .p-6 {
            padding: 1rem;
        }
    }
</style>
