<x-layouts.main>
    <x-slot:title>Productos</x-slot:title>

    <div class="container mx-auto p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Nuestros Productos</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($product->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($product as $producto)
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                        @if ($producto->image || $producto->image_path)
                            <img src="{{ $producto->image ?? asset($producto->image_path) }}"
                                alt="{{ $producto->title ?? $producto->name }}"
                                class="w-full h-48 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                                <span class="text-gray-500">Sin imagen</span>
                            </div>
                        @endif

                        <h3 class="text-xl font-semibold mb-2">{{ $producto->title ?? $producto->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($producto->description, 100) }}</p>

                        <div class="flex justify-between items-center mb-4">
                            <span
                                class="text-2xl font-bold text-green-600">${{ number_format($producto->price, 2) }}</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">
                                {{ $producto->category }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">
                                Stock: {{ $producto->stock }}
                            </span>
                            <span
                                class="px-2 py-1 rounded text-sm {{ $producto->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $producto->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('product.show', $producto) }}"
                                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition-colors block text-center">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <h3 class="text-xl text-gray-600 mb-4">No hay productos disponibles</h3>
                <p class="text-gray-500">Pronto agregaremos nuevos productos a nuestro catálogo.</p>
            </div>
        @endif
    </div>
</x-layouts.main>
