<?php
/** @var \Illuminate\Pagination\LengthAwarePaginator $orders */
?>
<x-layouts.main>
    <x-slot:title>Mis Órdenes - Puente Papel</x-slot:title>

    <section class="container mx-auto p-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-6xl mx-auto mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Mis Órdenes</h2>
            <p class="text-gray-600 mt-2">Historial de todas tus compras realizadas</p>
        </div>

        {{-- Mensajes de feedback --}}
        @if (session('feedback.message'))
            <div
                class="mb-4 max-w-6xl mx-auto px-4 py-3 rounded-lg border {{ session('feedback.type') === 'success' ? 'bg-green-50 border-green-200 text-green-700' : (session('feedback.type') === 'warning' ? 'bg-yellow-50 border-yellow-200 text-yellow-700' : 'bg-red-50 border-red-200 text-red-700') }}">
                {!! session('feedback.message') !!}
            </div>
        @endif

        @if ($orders->count() > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6 max-w-6xl mx-auto">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b-2 border-pink-200">
                                <th class="text-left py-4 px-2 font-semibold text-gray-800">Orden #</th>
                                <th class="text-left py-4 px-2 font-semibold text-gray-800">Fecha</th>
                                <th class="text-left py-4 px-2 font-semibold text-gray-800">Productos</th>
                                <th class="text-right py-4 px-2 font-semibold text-gray-800">Total</th>
                                <th class="text-center py-4 px-2 font-semibold text-gray-800">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-b border-pink-100 hover:bg-pink-50 transition-colors">
                                    <td class="py-4 px-2">
                                        <span class="font-semibold text-gray-800">#{{ $order->id }}</span>
                                    </td>
                                    <td class="py-4 px-2">
                                        <span class="text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                                    </td>
                                    <td class="py-4 px-2">
                                        <div class="space-y-1">
                                            @foreach ($order->orderItems as $item)
                                                <div class="text-sm text-gray-700">
                                                    <span class="font-medium">{{ $item->quantity }}x</span>
                                                    <span>{{ $item->product->name ?? ($item->product->title ?? 'Producto eliminado') }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <span class="font-bold text-gray-800 text-lg">
                                            ${{ number_format($order->total_amount, 2, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-2 text-center">
                                        <a href="{{ route('orders.show', $order) }}"
                                            class="inline-block px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors text-sm">
                                            Ver Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Paginación --}}
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        @else
            <div class="bg-pink-50 px-8 py-12 rounded-2xl max-w-2xl mx-auto border-2 border-pink-200">
                <div class="text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">No tienes órdenes todavía</h2>
                    <p class="text-gray-600 mb-6">Cuando realices una compra, aparecerá aquí.</p>
                    <a href="{{ route('product.index') }}"
                        class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                        Ver Productos
                    </a>
                </div>
            </div>
        @endif
    </section>
</x-layouts.main>
