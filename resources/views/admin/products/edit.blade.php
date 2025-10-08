<x-layouts.admin>
    <x-slot:title>Editar Producto</x-slot:title>
    
    @php
        $breadcrumbs = [
            ['name' => 'Productos', 'url' => route('admin.product.index'), 'active' => false],
            ['name' => 'Editar Producto', 'url' => '#', 'active' => true]
        ];
    @endphp

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Editar Producto</h1>
            <p class="text-gray-600 mt-2">Modifica la información del producto</p>
        </div>
        <a href="{{ route('admin.product.index') }}" 
           class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver al listado</span>
        </a>
    </div>

    {{-- Formulario --}}
    <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-2xl mx-auto">
        <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                {{-- Título --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-800 mb-2">
                        Título del Producto *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $product->title) }}"
                           class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                           placeholder="Escribe el título del producto..."
                           required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nombre (opcional) --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-2">
                        Nombre (opcional)
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $product->name) }}"
                           class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                           placeholder="Nombre alternativo del producto...">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-800 mb-2">
                        Descripción *
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="6"
                              class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                              placeholder="Describe el producto..."
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Precio --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-800 mb-2">
                        Precio
                    </label>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           value="{{ old('price', $product->price) }}"
                           step="0.01"
                           min="0"
                           class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                           placeholder="0.00">
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Categoría --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-800 mb-2">
                        Categoría
                    </label>
                    <input type="text" 
                           id="category" 
                           name="category" 
                           value="{{ old('category', $product->category) }}"
                           class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                           placeholder="Ej: Comunicación, Lectura, etc.">
                    @error('category')
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
                        <option value="active" {{ old('status', $product->status ?? 'active') == 'active' ? 'selected' : '' }}>Activo</option>
                        <option value="inactive" {{ old('status', $product->status ?? 'active') == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div>
                    <label class="block text-sm font-medium text-gray-800 mb-2">
                        Imagen del Producto
                    </label>
                    <x-image-upload 
                        name="image" 
                        type="products" 
                        :currentImage="$product->image"
                        class="w-full"
                    />
                </div>

                {{-- Acciones --}}
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg">
                        Actualizar Producto
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Vista previa de imagen
            document.getElementById('image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview-img').src = e.target.result;
                        document.getElementById('image-preview').classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</x-layouts.admin>