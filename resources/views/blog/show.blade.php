<x-layouts.main>
    <x-slot:title>{{ $post->title }} :: Blog Puente Papel</x-slot:title>

    {{-- Breadcrumbs --}}
    @php
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
            ['name' => 'Blog', 'url' => route('blog.index'), 'active' => false],
            ['name' => $post->title, 'url' => '#', 'active' => true]
        ];
    @endphp

    <article class="max-w-4xl mx-auto px-4 py-8">
        {{-- Header del post --}}
        <header class="mb-8">
            {{-- Imagen destacada --}}
            @if($post->featured_image_url)
                <div class="mb-6 rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ $post->featured_image_url }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-64 md:h-80 object-cover"
                         loading="lazy">
                </div>
            @endif

            {{-- Título --}}
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                {{ $post->title }}
            </h1>

            {{-- Meta información --}}
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-6">
                @if($post->user)
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">
                                {{ substr($post->user->name, 0, 1) }}
                            </span>
                        </div>
                        <span class="font-medium">{{ $post->user->name }}</span>
                    </div>
                @endif
                
                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <time datetime="{{ $post->created_at->format('Y-m-d') }}">
                        {{ $post->created_at->format('d \d\e F \d\e Y') }}
                    </time>
                </div>

                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </header>

        {{-- Contenido del post --}}
        <div class="prose prose-lg max-w-none">
            <div class="text-gray-800 leading-relaxed">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        {{-- Navegación entre posts --}}
        <nav class="mt-12 pt-8 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <a href="{{ route('blog.index') }}" 
                   class="inline-flex items-center space-x-2 text-red-600 hover:text-red-700 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Volver al blog</span>
                </a>

                {{-- Compartir (opcional) --}}
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">Compartir:</span>
                    <button onclick="sharePost()" 
                            class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors duration-200"
                            title="Compartir artículo">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </article>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada para el contenido
            gsap.fromTo('article', {
                opacity: 0,
                y: 30
            }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power2.out"
            });

            // Función para compartir
            window.sharePost = function() {
                if (navigator.share) {
                    navigator.share({
                        title: '{{ $post->title }}',
                        text: '{{ Str::limit(strip_tags($post->content), 100) }}',
                        url: window.location.href
                    });
                } else {
                    // Fallback: copiar URL al portapapeles
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        alert('URL copiada al portapapeles');
                    });
                }
            };
        });
    </script>
</x-layouts.main>
