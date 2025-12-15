<x-layouts.admin>
    <section>
        <x-slot:title>Dashboard</x-slot:title>
        <h2 class="sr-only">Dashboard</h2>
        {{-- Estadísticas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Productos --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Productos</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['products'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Posts --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Posts</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['posts'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Usuarios --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Usuarios</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['users'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            {{-- Posts Publicados --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Posts Publicados</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['published_posts'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Estadísticas Destacadas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- Producto Más Vendido --}}
            <div
                class="bg-gradient-to-br from-red-700 to-red-900 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
                <img src="{{ asset('storage/images/puente_papel_icon.png') }}" alt="puente papel logo"
                    class="absolute -bottom-6 -right-6 w-28 h-25 ">

                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                        <p class="text-red-200 text-sm font-semibold uppercase tracking-wide">Producto Más Vendido</p>
                    </div>

                    @if ($stats['top_product'])
                        <div class="flex items-center gap-6">
                            <img class="h-24 w-24 rounded-xl object-cover shadow-lg border-2 border-white/20"
                                src="{{ $stats['top_product']->image_url }}" alt="{{ $stats['top_product']->name }}">
                            <div>
                                <h3 class="text-2xl font-bold mb-2">{{ $stats['top_product']->name }}</h3>
                                <p class="text-red-200 text-lg">
                                    <span
                                        class="text-3xl font-bold text-white">{{ $stats['top_product']->total_sold }}</span>
                                    unidades vendidas
                                </p>
                            </div>
                        </div>
                    @else
                        <p class="text-red-200">No hay ventas registradas</p>
                    @endif
                </div>
            </div>

            {{-- Total de Ventas --}}
            <div
                class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
                <img src="{{ asset('storage/images/puente_papel_icon.png') }}" alt="puente papel logo"
                    class="absolute -bottom-6 -right-6 w-28 h-25 ">

                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-6 h-6 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-emerald-200 text-sm font-semibold uppercase tracking-wide">Total Facturado</p>
                    </div>

                    <div class="flex items-end gap-2">
                        <span
                            class="text-5xl font-bold">${{ number_format($stats['total_sales'], 2, ',', '.') }}</span>
                    </div>
                    <p class="text-emerald-200 mt-2">en ventas completadas</p>
                </div>
            </div>
        </div>

        {{-- Acciones rápidas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Acciones rápidas --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.product.create') }}"
                        class="flex items-center space-x-3 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span class="text-blue-800 font-medium">Crear Nuevo Producto</span>
                    </a>

                    <a href="{{ route('admin.blog.create') }}"
                        class="flex items-center space-x-3 p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span class="text-green-800 font-medium">Crear Nuevo Post</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center space-x-3 p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span class="text-purple-800 font-medium">Gestionar Usuarios</span>
                    </a>
                </div>
            </div>

            {{-- Actividad reciente --}}
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Actividad Reciente</h3>
                <div class="space-y-3">
                    @if (isset($recent_activity) && count($recent_activity) > 0)
                        @foreach ($recent_activity as $activity)
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-800">{{ $activity['description'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 text-center py-4">No hay actividad reciente</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-layouts.admin>
