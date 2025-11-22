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
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- Sección de Información del Producto --}}
            <div class="space-y-6">
                {{-- Título y Precio --}}
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        {{ $productData['title'] ?? 'Título del producto' }}</h2>
                    <p class="text-2xl font-semibold text-gray-900">
                        ${{ number_format($productData['price'], 0, ',', '.') }}</p>
                    <a href="#" class="text-red-600 text-sm hover:underline">Ver medios de pagos</a>
                </div>

                {{-- Botones de Acción --}}
                @if ($product && $product->is_active && $product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        {{-- Selector de cantidad --}}
                        <div class="flex items-center gap-3 mb-4">
                            <label for="quantity_{{ $product->id }}" class="text-gray-700 font-medium">Cantidad:</label>
                            <select id="quantity_{{ $product->id }}" name="quantity"
                                class="appearance-none bg-pink-100 border-2 border-pink-300 rounded-xl px-4 py-2 pr-8 text-gray-800 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                                @for ($i = 1; $i <= min(10, $product->stock); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="text-sm text-gray-700">(Stock: {{ $product->stock }})</span>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="space-y-3">
                            <button type="submit" name="buy_now" value="1"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg disabled:opacity-50">
                                Comprar ahora
                            </button>
                            <button type="submit" name="add_to_cart" value="1"
                                class="w-full bg-pink-100 hover:bg-pink-200 text-gray-800 font-semibold py-3 px-6 rounded-xl transition-all duration-300 border-2 border-pink-300 hover:shadow-lg disabled:opacity-50">
                                Añadir al carrito
                            </button>
                        </div>
                    </form>
                @elseif ($product && !$product->is_active)
                    <div class="space-y-3">
                        <button disabled
                            class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-6 rounded-xl cursor-not-allowed">
                            Producto no disponible
                        </button>
                    </div>
                @elseif ($product && $product->stock <= 0)
                    <div class="space-y-3">
                        <button disabled
                            class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-6 rounded-xl cursor-not-allowed">
                            Sin stock disponible
                        </button>
                    </div>
                @endif

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

