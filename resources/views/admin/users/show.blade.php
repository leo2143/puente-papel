<?php
/** @var \App\Models\User $user */
/** @var int $totalPurchases */
/** @var float $totalSpent */
?>
<x-layouts.admin>
    <x-slot:title>Usuario: {{ $user->name }} - Admin</x-slot:title>

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Detalle del Usuario</h2>
            <p class="text-gray-600 mt-2">Información completa y historial de compras</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.users.edit', $user) }}"
                class="px-4 py-2 bg-primary-color hover:bg-red-700 text-white font-semibold rounded-lg transition-colors">
                Editar Usuario
            </a>
            <a href="{{ route('admin.users.index') }}"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                Volver
            </a>
        </div>
    </div>

    <div class="space-y-6">
        {{-- Información del usuario --}}
        <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Información Personal</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nombre</p>
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Apellido</p>
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->last_name ?? 'No especificado' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Email</p>
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Teléfono</p>
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->phone ?? 'No especificado' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Rol</p>
                    <span
                        class="inline-block px-3 py-1 {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }} rounded-lg font-semibold">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Estado</p>
                    <span
                        class="inline-block px-3 py-1 {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} rounded-lg font-semibold">
                        {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Fecha de Registro</p>
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->created_at->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">ID de Usuario</p>
                    <p class="font-semibold text-gray-800 text-lg">#{{ $user->id }}</p>
                </div>
            </div>
        </div>

        {{-- Estadísticas de compras --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class=" bg-red-800/50 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium mb-1">Total de Compras</p>
                        <p class="text-4xl font-bold">{{ $totalPurchases }}</p>
                    </div>

                </div>
            </div>

            <div class="bg-red-800/50 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium mb-1">Total Gastado</p>
                        <p class="text-4xl font-bold">${{ number_format($totalSpent, 2, ',', '.') }}</p>
                    </div>

                </div>
            </div>
        </div>

        {{-- Historial de compras --}}
        <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Historial de Compras</h3>

            @forelse($user->orders as $order)
                <div class="bg-gray-50 rounded-lg p-6 mb-4 border border-gray-200 hover:shadow-md transition-shadow">
                    {{-- Cabecera de la orden --}}
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 pb-4 border-b border-gray-300">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-lg font-bold text-gray-800">Orden #{{ $order->id }}</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-lg text-sm font-semibold">
                                    Completada
                                </span>
                            </div>
                            <p class="text-sm text-gray-600">
                                Fecha: {{ $order->created_at->format('d/m/Y \a \l\a\s H:i') }}
                            </p>
                        </div>
                        <div class="mt-3 md:mt-0">
                            <p class="text-sm text-gray-600">Total de la orden</p>
                            <p class="text-2xl font-bold text-red-600">
                                ${{ number_format($order->total_amount, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    {{-- Productos de la orden --}}
                    <div class="space-y-3">
                        <h3 class="font-semibold text-gray-800 mb-3">Productos:</h3>
                        @foreach ($order->orderItems as $item)
                            <div class="flex items-center gap-4 bg-white rounded-lg p-4 border border-gray-200">
                                {{-- Imagen --}}
                                @if ($item->product && $item->product->image_url)
                                    <img src="{{ $item->product->image_url }}"
                                        alt="{{ $item->product->name ?? $item->product->title }}"
                                        class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <span class="text-gray-400 text-xs">Sin imagen</span>
                                    </div>
                                @endif

                                {{-- Info del producto --}}
                                <div class="flex-grow">
                                    <h4 class="font-semibold text-gray-800">
                                        {{ $item->product->name ?? ($item->product->title ?? 'Producto eliminado') }}
                                    </h4>
                                    <div class="flex flex-wrap gap-4 mt-1 text-sm text-gray-600">
                                        <span>Cantidad: <strong>{{ $item->quantity }}</strong></span>
                                        <span>Precio unitario:
                                            <strong>${{ number_format($item->price, 2, ',', '.') }}</strong></span>
                                    </div>
                                </div>

                                {{-- Subtotal --}}
                                <div class="text-right flex-shrink-0">
                                    <p class="text-sm text-gray-600">Subtotal</p>
                                    <p class="font-bold text-gray-800 text-lg">
                                        ${{ number_format($item->price * $item->quantity, 2, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 rounded-lg p-8 text-center border-2 border-gray-200">
                    <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sin compras realizadas</h3>
                    <p class="text-gray-600">Este usuario aún no ha realizado ninguna compra.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.admin>
