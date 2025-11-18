<x-layouts.main>
    <x-slot:title>Productos</x-slot:title>

    <section class="container mx-auto p-8">
            <h2 class="hidden">Productos</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($product->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($product as $producto)
                    <a href="{{ route('product.show', $producto) }}">

                        <div
                            class="bg-pink-50 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border-2 border-pink-200 group">
                            @if ($producto->image_url)
                                <img src="{{ $producto->image_url }}" alt="{{ $producto->title ?? $producto->name }}"
                                    class="w-full h-48 object-cover rounded-lg mb-4">
                            @else
                                <div
                                    class="w-full h-48 bg-pink-100 rounded-xl mb-4 flex items-center justify-center border-2 border-pink-300">
                                    <span class="text-gray-600">Sin imagen</span>
                                </div>
                            @endif

                            <h3 class="text-xl font-semibold mb-2 group-hover:text-red-600 transition-all duration-300 text-gray-800">
                                {{ $producto->title ?? $producto->name }}
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($producto->description, 100) }}</p>

                            <div class="flex justify-between items-center mb-4">
                                <span
                                    class="text-2xl font-bold text-gray-800">${{ number_format($producto->price, 2) }}</span>
                                <span
                                    class="px-2 py-1 bg-gray-100 text-black-800 rounded-xl text-sm border border-gray-300">
                                    {{ $producto->category }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-600">
                                    Stock: {{ $producto->stock }}
                                </span>

                            </div>

                            <div class="mt-4 space-y-2">
                                @if ($producto->is_active && $producto->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST"
                                        class="add-to-cart-form-quick">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $producto->id }}">
                                        <input type="hidden" name="quantity" value="1">

                                    </form>
                                @elseif (!$producto->is_active)
                                    <button disabled
                                        class="w-full bg-gray-300 text-gray-500 font-semibold py-2 px-4 rounded-xl cursor-not-allowed text-sm">
                                        No Disponible
                                    </button>
                                @else
                                    <button disabled
                                        class="w-full bg-gray-300 text-gray-500 font-semibold py-2 px-4 rounded-xl cursor-not-allowed text-sm">
                                        Sin Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-pink-50 px-8 py-12 rounded-2xl max-w-2xl mx-auto border-2 border-pink-200">
                <h3 class="text-xl text-gray-800 mb-4 text-center">No hay productos disponibles</h3>
                <p class="text-gray-600">Pronto agregaremos nuevos productos a nuestro catálogo.</p>
            </div>
        @endif
    </section>
</x-layouts.main>
