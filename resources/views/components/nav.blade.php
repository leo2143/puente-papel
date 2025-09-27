{{-- Navegación principal --}}
<nav class="px-4 py-3 relative" role="navigation" aria-label="Navegación principal">
    <div class="flex items-center justify-between max-w-7xl mx-auto">
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

        {{-- Botones de acción --}}
        <div class="flex items-center space-x-2">
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

            {{-- Menú de usuario --}}
            @auth
                {{-- Usuario autenticado --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                        aria-label="Menú de usuario">
                        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">
                                {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                            </span>
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-gray-700">
                            {{ auth()->user()->name }}
                        </span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    {{-- Dropdown menu --}}
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">

                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}
                                {{ auth()->user()->last_name }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>

                        <a href="{{ route('auth.profile') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Mi Perfil
                        </a>

                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            Mis Pedidos
                        </a>

                        <div class="border-t border-gray-100"></div>

                        <form action="{{ route('auth.logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Usuario no autenticado --}}
                <div class="flex items-center space-x-2">
                    <a href="{{ route('auth.login') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600 transition-colors duration-200">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('auth.register') }}"
                        class="px-3 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md transition-colors duration-200">
                        Registrarse
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animaciones GSAP para elementos de navegación
        gsap.fromTo('#mobile-menu-btn, #cart-btn', {
            opacity: 0,
            scale: 0.8
        }, {
            opacity: 1,
            scale: 1,
            duration: 0.5,
            ease: "power2.out",
            stagger: 0.1
        });

        // Efecto hover en botones
        const buttons = document.querySelectorAll('button, a');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.05,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            button.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        });
    });
</script>
