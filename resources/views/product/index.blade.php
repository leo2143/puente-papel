<x-layouts.main>
    <x-slot:title>Productos</x-slot:title>

    <section class="container mx-auto p-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-4xl mx-auto mb-8">
            <h1 class="text-3xl font-bold text-gray-800 text-center">Nuestros Productos</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($product->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($product as $producto)
                    <div class="bg-pink-50 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-pink-200">
                        @if ($producto->image_url)
                            <img src="{{ $producto->image_url }}"
                                alt="{{ $producto->title ?? $producto->name }}"
                                class="w-full h-48 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-48 bg-pink-100 rounded-xl mb-4 flex items-center justify-center border-2 border-pink-300">
                                <span class="text-gray-600">Sin imagen</span>
                            </div>
                        @endif

                        <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $producto->title ?? $producto->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ Str::limit($producto->description, 100) }}</p>

                        <div class="flex justify-between items-center mb-4">
                            <span
                                class="text-2xl font-bold text-gray-800">${{ number_format($producto->price, 2) }}</span>
                            <span class="px-2 py-1 bg-pink-100 text-pink-800 rounded-xl text-sm border border-pink-300">
                                {{ $producto->category }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">
                                Stock: {{ $producto->stock }}
                            </span>
                            <span
                                class="px-2 py-1 rounded-xl text-sm border {{ $producto->is_active ? 'bg-green-100 text-green-800 border-green-300' : 'bg-red-100 text-red-800 border-red-300' }}">
                                {{ $producto->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('product.show', $producto) }}"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg block text-center">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-pink-50 px-8 py-12 rounded-2xl max-w-2xl mx-auto text-center border-2 border-pink-200">
                <h2 class="text-xl text-gray-800 mb-4">No hay productos disponibles</h2>
                <p class="text-gray-600">Pronto agregaremos nuevos productos a nuestro catálogo.</p>
            </div>
        @endif
    </section>
</x-layouts.main>
