<x-layouts.admin>
    <x-slot:title>Editar Post</x-slot:title>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Editar Post</h2>
            <p class="text-gray-600 mt-2">Modifica el contenido del post</p>
        </div>
        <a href="{{ route('admin.blog.index') }}"
            class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            <span>Volver al listado</span>
        </a>
    </div>

    {{-- Formulario --}}
    <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-2xl mx-auto">
        <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data"
            id="blog-form">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Título --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-800 mb-2">
                        Título del Post *
                    </label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-lg"
                        placeholder="Escribe un título atractivo..." required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Editor Markdown --}}
                <div>
                    <dile-editor name="content" label="Contenido del Post *"
                        value="{{ old('content', $post->content) }}" language="es" viewSelected="editor"></dile-editor>
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Estado --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-800 mb-2">
                        Estado
                    </label>
                    <select id="status" name="status"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Borrador
                        </option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                            Publicado
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagen destacada --}}
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-800 mb-2">
                        Imagen Destacada
                    </label>
                    <x-image-upload name="featured_image" type="blog" :currentImage="$post->featured_image" class="w-full" />
                </div>

                {{-- Acciones --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg">
                        Actualizar Post
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>
