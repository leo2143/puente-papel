<?php
/** @var \App\Models\Order $order */
?>
<x-layouts.main>
    <x-slot:title>Orden #{{ $order->id }} - Puente Papel</x-slot:title>

    <section class="container mx-auto p-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-6xl mx-auto mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Detalle de Orden #{{ $order->id }}</h2>
            <p class="text-gray-600 mt-2">Realizada el {{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}</p>
        </div>

        {{-- Mensajes de feedback --}}
        @if (session('feedback.message'))
            <div
                class="mb-4 max-w-6xl mx-auto px-4 py-3 rounded-lg border {{ session('feedback.type') === 'success' ? 'bg-green-50 border-green-200 text-green-700' : (session('feedback.type') === 'warning' ? 'bg-yellow-50 border-yellow-200 text-yellow-700' : 'bg-red-50 border-red-200 text-red-700') }}">
                {!! session('feedback.message') !!}
            </div>
        @endif

        <div class="max-w-6xl mx-auto space-y-6">
            {{-- Información de la orden --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-pink-200">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Información de la Orden</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Número de Orden</p>
                        <p class="font-semibold text-gray-800">#{{ $order->id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Fecha de Compra</p>
                        <p class="font-semibold text-gray-800">{{ $order->created_at->format('d/m/Y H:i:s') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Estado</p>
                        @switch($order->status)
                            @case('paid')
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-lg font-semibold">
                                    Pagada
                                </span>
                                @break
                            @case('pending')
                                <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-lg font-semibold">
                                    Pendiente de pago
                                </span>
                                @break
                            @case('failed')
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-lg font-semibold">
                                    Pago fallido
                                </span>
                                @break
                            @case('cancelled')
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-lg font-semibold">
                                    Cancelada
                                </span>
                                @break
                            @default
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 rounded-lg font-semibold">
                                    {{ ucfirst($order->status) }}
                                </span>
                        @endswitch
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total</p>
                        <p class="font-bold text-red-600 text-xl">
                            ${{ number_format($order->total_amount, 2, ',', '.') }}
                        </p>
                    </div>
                    @if($order->payment_id)
                    <div>
                        <p class="text-sm text-gray-600">ID de Pago (Mercado Pago)</p>
                        <p class="font-mono text-gray-800">{{ $order->payment_id }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Datos del comprador --}}
            @if ($order->user)
                <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-pink-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Datos del Comprador</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Nombre completo</p>
                            <p class="font-semibold text-gray-800">{{ $order->user->name }}
                                {{ $order->user->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-semibold text-gray-800">{{ $order->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Teléfono</p>
                            <p class="font-semibold text-gray-800">{{ $order->user->phone ?? 'No especificado' }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Productos de la orden --}}
            <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-pink-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Productos Comprados</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-pink-200">
                                <th class="text-left py-4 px-2 font-semibold text-gray-800 w-1/12">Imagen</th>
                                <th class="text-left py-4 px-2 font-semibold text-gray-800">Producto</th>
                                <th class="text-center py-4 px-2 font-semibold text-gray-800 w-1/6">Cantidad</th>
                                <th class="text-right py-4 px-2 font-semibold text-gray-800 w-1/6">Precio Unitario</th>
                                <th class="text-right py-4 px-2 font-semibold text-gray-800 w-1/6">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr class="border-b border-pink-100">
                                    <td class="py-4 px-2">
                                        @if ($item->product && $item->product->image_url)
                                            <img src="{{ $item->product->image_url }}"
                                                alt="{{ $item->product->name ?? $item->product->title }}"
                                                class="w-20 h-20 object-cover rounded-lg">
                                        @else
                                            <div
                                                class="w-20 h-20 bg-pink-100 rounded-lg flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">Sin imagen</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-2">
                                        <h4 class="font-semibold text-gray-800">
                                            {{ $item->product->name ?? ($item->product->title ?? 'Producto eliminado') }}
                                        </h4>
                                        @if (!$item->product)
                                            <p class="text-sm text-red-600">Este producto ya no está disponible</p>
                                        @endif
                                    </td>
                                    <td class="py-4 px-2 text-center">
                                        <span class="text-gray-700">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <span
                                            class="text-gray-700">${{ number_format($item->price, 2, ',', '.') }}</span>
                                        <p class="text-xs text-gray-500">(Precio histórico)</p>
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <span class="font-semibold text-gray-800">
                                            ${{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="border-t-2 border-pink-300">
                                <td colspan="3" class="py-4 px-2 text-right font-bold text-lg text-gray-800">
                                    Total:
                                </td>
                                <td colspan="2" class="py-4 px-2 text-right font-bold text-xl text-red-600">
                                    ${{ number_format($order->total_amount, 2, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Botones de acción --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('orders.index') }}"
                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors text-center">
                    Volver a Mis Órdenes
                </a>
                <a href="{{ route('product.index') }}"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors text-center">
                    Seguir Comprando
                </a>
            </div>
        </div>
    </section>
</x-layouts.main>
