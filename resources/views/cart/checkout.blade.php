
<x-layouts.main>
    <x-slot:title>Checkout - Puente Papel</x-slot:title>

    <section class="container mx-auto p-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-6xl mx-auto mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Resumen de Compra</h2>
        </div>

        {{-- Mensajes de feedback --}}
        @if (session('feedback.message'))
            <div
                class="mb-4 max-w-6xl mx-auto px-4 py-3 rounded-lg border {{ session('feedback.type') === 'success' ? 'bg-green-50 border-green-200 text-green-700' : (session('feedback.type') === 'warning' ? 'bg-yellow-50 border-yellow-200 text-yellow-700' : 'bg-red-50 border-red-200 text-red-700') }}">
                {!! session('feedback.message') !!}
            </div>
        @endif

        @if (!empty($cart))
            <div class="max-w-6xl mx-auto space-y-6">
                {{-- Datos del comprador --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-pink-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Datos del Comprador</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nombre completo</p>
                            <p class="font-semibold text-gray-800">{{ $user->name }} {{ $user->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-semibold text-gray-800">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Teléfono</p>
                            <p class="font-semibold text-gray-800">{{ $user->phone ?? 'No especificado' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Resumen de productos --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-pink-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Resumen de Productos</h3>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $productId => $item)
                                    @php
                                        $product = $products->get($productId);
                                    @endphp
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
                                            @if ($product && $product->stock < $item['quantity'])
                                                <p class="text-sm text-red-600 mt-1">
                                                    ⚠️ Stock insuficiente (disponible: {{ $product->stock }})
                                                </p>
                                            @endif
                                        </td>
                                        <td class="py-4 px-2 text-center">
                                            <span class="text-gray-700">{{ $item['quantity'] }}</span>
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
                                    </tr>
                                @endforeach
                                <tr class="border-t-2 border-pink-300">
                                    <td colspan="3" class="py-4 px-2 text-right font-bold text-lg text-gray-800">
                                        Total a pagar:
                                    </td>
                                    <td colspan="2" class="py-4 px-2 text-right font-bold text-xl text-red-600">
                                        ${{ number_format($total, 2, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="flex flex-col items-center md:flex-row md:justify-end gap-4">
                    <form action="{{ route('orders.store') }}" method="POST" class="w-full md:w-auto" novalidate>
                        @csrf
                        <button type="submit" id="mercadopago_payment_button" class="w-full md:w-auto">
                        </button>
                    </form>
                    <a href="{{ route('cart.index') }}"
                        class="w-full md:w-auto px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors text-center">
                        Volver al Carrito
                    </a>
                </div>
            </div>
        @else
            <div class="bg-pink-50 px-8 py-12 rounded-2xl max-w-2xl mx-auto border-2 border-pink-200">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">No hay productos para finalizar la compra</h3>
                    <p class="text-gray-600 mb-6">Tu carrito está vacío. Agrega productos antes de proceder al checkout.
                    </p>
                    <a href="{{ route('cart.index') }}"
                        class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                        Volver al Carrito
                    </a>
                </div>
            </div>
        @endif
    </section>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const publicKey = '<?= $MPPublickey; ?>';
        const preferenceId = '<?= $preference->id; ?>';

        const mp = new MercadoPago(publicKey);
        
        const bricksBuilder = mp.bricks();
        const renderWalletBrick = async (bricksBuilder) => {
            await bricksBuilder.create("wallet", "mercadopago_payment_button", {
                initialization: {
                    preferenceId: preferenceId,
                }
            });
        };

        renderWalletBrick(bricksBuilder);
    </script>
</x-layouts.main>
