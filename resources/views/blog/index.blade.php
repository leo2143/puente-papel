<x-layouts.main>
    <x-slot:title>Blog</x-slot:title>

    {{-- Header del blog --}}
    <section class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-4xl mx-auto mb-12 text-center border-2 border-pink-200">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Blog</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Descubre artículos, consejos y recursos educativos para el desarrollo infantil
            </p>
        </div>

        {{-- Lista de posts --}}
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <article class="bg-pink-50 rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group cursor-pointer border-2 border-pink-200"
                        onclick="window.location.href='{{ route('blog.show', $post->id) }}'">
                        
                        {{-- Imagen del post --}}
                        <div class="relative overflow-hidden">
                            @if($post->featured_image_url)
                                <img src="{{ $post->featured_image_url }}" 
                                     alt="{{ $post->title }}"
                                     class="w-full h-48 md:h-56 object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @else
                                <div class="w-full h-48 md:h-56 bg-pink-100 flex items-center justify-center border-2 border-pink-300">
                                    <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                        </div>

                        {{-- Contenido del post --}}
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-red-600 transition-colors duration-200">
                                {{ $post->title }}
                            </h2>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>

                            {{-- Meta información --}}
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    @if($post->user)
                                        <div class="w-6 h-6 bg-pink-300 rounded-full flex items-center justify-center border border-pink-400">
                                            <span class="text-gray-800 text-xs font-medium">
                                                {{ substr($post->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <span>{{ $post->user->name }}</span>
                                    @endif
                                </div>
                                <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                                    {{ $post->created_at->format('d M Y') }}
                                </time>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            {{-- Estado vacío --}}
            <div class="bg-pink-50 px-8 py-16 rounded-2xl max-w-2xl mx-auto text-center border-2 border-pink-200">
                <div class="w-24 h-24 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-pink-300">
                    <svg class="w-12 h-12 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">No hay artículos disponibles</h3>
                <p class="text-gray-600 max-w-md mx-auto">
                    Próximamente publicaremos contenido educativo y recursos para el desarrollo infantil.
                </p>
            </div>
        @endif
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada para los posts
            gsap.fromTo('.grid > article', {
                opacity: 0,
                y: 50
            }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power2.out",
                stagger: 0.1
            });
        });
    </script>
</x-layouts.main>
