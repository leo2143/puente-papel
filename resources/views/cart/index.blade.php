<x-layouts.main>
    <x-slot:title>Carrito de Compras - Puente Papel</x-slot:title>

    <section class="container mx-auto p-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-6xl mx-auto mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Carrito de Compras</h2>
        </div>

        {{-- Mensajes de feedback --}}
        @if (session('feedback.message'))
            <div
                class="mb-4 max-w-6xl mx-auto px-4 py-3 rounded-lg border {{ session('feedback.type') === 'success' ? 'bg-green-50 border-green-200 text-green-700' : (session('feedback.type') === 'warning' ? 'bg-yellow-50 border-yellow-200 text-yellow-700' : 'bg-red-50 border-red-200 text-red-700') }}">
                {!! session('feedback.message') !!}
            </div>
        @endif

        @if (!empty($cart))
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-6xl mx-auto">
                <form action="{{ route('cart.update') }}" method="POST" id="cart-form" novalidate>
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b-2 border-pink-200">
                                    <th class="text-left py-4 px-2 font-semibold text-gray-800 w-1/12">Imagen</th>
                                    <th class="text-left py-4 px-2 font-semibold text-gray-800">Producto</th>
                                    <th class="text-center py-4 px-2 font-semibold text-gray-800 w-1/6">Cantidad</th>
                                    <th class="text-right py-4 px-2 font-semibold text-gray-800 w-1/6">Precio Unitario
                                    </th>
                                    <th class="text-right py-4 px-2 font-semibold text-gray-800 w-1/6">Subtotal</th>
                                    <th class="text-center py-4 px-2 font-semibold text-gray-800 w-1/12"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $productId => $item)
                                    <tr class="border-b border-pink-100">
                                        <td class="py-4 px-2">
                                            @if ($item['image_url'])
                                                <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"
                                                    class="w-20 h-20 object-cover rounded-lg">
                                            @else
                                                <div
                                                    class="w-20 h-20 bg-pink-100 rounded-lg flex items-center justify-center">
                                                    <span class="text-gray-400 text-xs">Sin imagen</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-2">
                                            <h4 class="font-semibold text-gray-800">{{ $item['name'] }}</h4>
                                        </td>
                                        <td class="py-4 px-2 text-center">
                                            <label for="quantity_{{ $productId }}" class="sr-only">Cantidad</label>
                                            <input type="number" name="items[{{ $productId }}]"
                                                id="quantity_{{ $productId }}" value="{{ $item['quantity'] }}"
                                                min="1"
                                                class="w-20 px-3 py-2 border border-pink-200 rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-pink-500">
                                        </td>
                                        <td class="py-4 px-2 text-right">
                                            <span
                                                class="text-gray-700">${{ number_format($item['price'], 2, ',', '.') }}</span>
                                        </td>
                                        <td class="py-4 px-2 text-right">
                                            <span class="font-semibold text-gray-800">
                                                ${{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-2 text-center">
                                            <button type="button"
                                                onclick="document.getElementById('delete-form-{{ $productId }}').submit();"
                                                class="text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-1 rounded transition-colors">
                                                <img src="{{ asset('storage/icons-svg/trash.svg') }}"
                                                    alt="Eliminar producto" title="Eliminar producto" class="w-5 h-5">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="border-t-2 border-pink-300">
                                    <td colspan="4" class="py-4 px-2 text-right font-bold text-lg text-gray-800">
                                        Total:
                                    </td>
                                    <td class="py-4 px-2 text-right font-bold text-lg text-red-600">
                                        ${{ number_format($total, 2, ',', '.') }}
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-6 justify-end">
                        <a href="{{ route('product.index') }}"
                            class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors text-center">
                            Seguir Comprando
                        </a>
                        <button type="submit" form="cart-form"
                            class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition-colors w-full sm:w-auto">
                            Actualizar Cantidades
                        </button>
                        <a href="{{ route('checkout') }}"
                            class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors text-center">
                            Finalizar Compra
                        </a>
                    </div>
                </form>

                {{-- Formularios ocultos para eliminar productos individuales --}}
                @foreach ($cart as $productId => $item)
                    <form id="delete-form-{{ $productId }}" action="{{ route('cart.remove', $productId) }}"
                        method="POST" style="display: none;"
                        onsubmit="return confirm('¿Estás seguro de eliminar este producto del carrito?')">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach

                {{-- Formulario separado para vaciar carrito --}}
                <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('¿Estás seguro de vaciar el carrito?')"
                        class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                        Vaciar Carrito
                    </button>
                </form>
            </div>
        @else
            <div class="bg-pink-50 px-8 py-12 rounded-2xl max-w-2xl mx-auto border-2 border-pink-200">
                <div class="text-center">
                    <img src="{{ asset('storage/icons-svg/shopping-bag.svg') }}" alt="Carrito vacío"
                        title="Carrito de compras vacío" class="w-24 h-24 mx-auto text-gray-400 mb-4">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Tu carrito está vacío</h3>
                    <p class="text-gray-600 mb-6">Agrega productos al carrito para comenzar a comprar.</p>
                    <a href="{{ route('product.index') }}"
                        class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                        Ver Productos
                    </a>
                </div>
            </div>
        @endif
    </section>
</x-layouts.main>
