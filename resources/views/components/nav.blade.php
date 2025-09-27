{{-- Navegación principal --}}
<nav class="px-4 py-3 relative" role="navigation" aria-label="Navegación principal ">
    <div class="flex items-center justify-between max-w-7xl mx-auto ">
        {{-- Botón hamburguesa --}}
        <button id="mobile-menu-btn" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
            aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="mobile-navigation">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        {{-- Barra de búsqueda --}}
        <div class="flex-1 mx-4">
            <div class="relative">
                <label for="search-input" class="sr-only">Buscar</label>
                <input type="text" id="search-input" placeholder="Buscar"
                    class="w-full px-4 py-2 pr-10 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800"
                    aria-label="Campo de búsqueda">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Botón carrito --}}
        <button id="cart-btn" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
            aria-label="Abrir carrito de compras" aria-expanded="false" aria-controls="cart-sidebar">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                </path>
            </svg>
        </button>
    </div>
</nav>
