{{-- Navegación principal --}}
<nav class="px-4 py-3 relative" role="navigation" aria-label="Navegación principal">
    <div class="max-w-7xl mx-auto">
        
        {{-- Layout móvil (como estaba originalmente) --}}
        <div class="flex items-center justify-between md:hidden">
            {{-- Botón hamburguesa --}}
            <button id="mobile-menu-btn" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="mobile-navigation">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            {{-- Barra de búsqueda móvil --}}
            <div class="flex-1 mx-4">
                <div class="relative">
                    <label for="search-input-mobile" class="sr-only">Buscar</label>
                    <input type="text" id="search-input-mobile" placeholder="Buscar"
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

            {{-- Botones de acción móvil --}}
            <div class="flex items-center space-x-2">
                {{-- Botón carrito móvil --}}
                <button id="cart-btn-mobile" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                    aria-label="Abrir carrito de compras" aria-expanded="false" aria-controls="cart-sidebar">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                        </path>
                    </svg>
                </button>

                {{-- Menú de usuario móvil --}}
            @auth
                {{-- Usuario autenticado --}}
                <div class="relative group">
                    <input type="checkbox" id="user-dropdown-toggle-mobile" class="hidden peer">
                    <label for="user-dropdown-toggle-mobile" 
                        class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200 cursor-pointer"
                        aria-label="Menú de usuario">
                        <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-medium">
                                {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                            </span>
                        </div>
                        <span class="hidden sm:block text-sm font-medium text-gray-700">
                            {{ auth()->user()->name }}
                        </span>
                        <svg class="w-4 h-4 text-gray-500 transition-transform duration-200 peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </label>

                    {{-- Dropdown menu --}}
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200 opacity-0 invisible scale-95 -translate-y-2 transition-all duration-200 ease-out peer-checked:opacity-100 peer-checked:visible peer-checked:scale-100 peer-checked:translate-y-0">

                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}
                                {{ auth()->user()->last_name }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                        </div>

                        <a href="{{ route('auth.profile') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Mi Perfil
                        </a>

                        {{-- Enlace al panel de administración para admins --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Panel de Administración
                            </a>
                        @endif

                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            Mis Pedidos
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                </path>
                            </svg>
                            Carrito
                        </a>

                        <div class="border-t border-gray-100"></div>

                        <form action="{{ route('auth.logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
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

        {{-- Layout desktop (barra de búsqueda arriba, navegación abajo) --}}
        <div class="hidden md:block" >
            {{-- Barra de búsqueda desktop (arriba) --}}
                                              {{-- Logo --}}

            <div class="mb-4 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-gray-800 hover:text-red-600 transition-colors duration-200">
                    <img src="{{ asset('images/utils/puente_papel_icon.png') }}" alt="Puente Papel" class="w-16 h-12 mr-2">
                </a>
                <div class="relative max-w-2xl mx-auto">
                    <label for="search-input-desktop" class="sr-only">Buscar</label>
                    <input type="text" id="search-input-desktop" placeholder="Buscar productos, artículos..."
                        class="w-full px-6 py-3 pr-12 border border-red-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-gray-800 text-lg"
                        aria-label="Campo de búsqueda">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Navegación desktop (abajo) --}}
            <div class="flex items-center justify-between">
                {{-- Logo y enlaces de navegación --}}
                <div class="flex items-center space-x-8">


                    {{-- Enlaces de navegación --}}
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('home') }}"
                            class="text-gray-700 hover:text-red-600 transition-colors duration-200 font-medium">
                            Inicio
                        </a>
                        <a href="{{ route('product.index') }}"
                            class="text-gray-700 hover:text-red-600 transition-colors duration-200 font-medium">
                            Productos
                        </a>
                        <a href="{{ route('blog.index') }}"
                            class="text-gray-700 hover:text-red-600 transition-colors duration-200 font-medium">
                            Blog
                        </a>
                        <a href="{{ route('about') }}"
                            class="text-gray-700 hover:text-red-600 transition-colors duration-200 font-medium">
                            Acerca de
                        </a>
                    </div>
                </div>

                {{-- Botones de acción desktop --}}
                <div class="flex items-center space-x-2">
                    {{-- Botón carrito desktop --}}
                    <button id="cart-btn-desktop" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                        aria-label="Abrir carrito de compras" aria-expanded="false" aria-controls="cart-sidebar">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                            </path>
                        </svg>
                    </button>

                    {{-- Menú de usuario desktop --}}
                    @auth
                        {{-- Usuario autenticado --}}
                        <div class="relative group">
                            <input type="checkbox" id="user-dropdown-toggle-desktop" class="hidden peer">
                            <label for="user-dropdown-toggle-desktop" 
                                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200 cursor-pointer"
                                aria-label="Menú de usuario">
                                <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">
                                        {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                                    </span>
                                </div>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ auth()->user()->name }}
                                </span>
                                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200 peer-checked:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </label>

                            {{-- Dropdown menu --}}
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200 opacity-0 invisible scale-95 -translate-y-2 transition-all duration-200 ease-out peer-checked:opacity-100 peer-checked:visible peer-checked:scale-100 peer-checked:translate-y-0">

                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}
                                        {{ auth()->user()->last_name }}</p>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                </div>

                                <a href="{{ route('auth.profile') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Mi Perfil
                                </a>

                                {{-- Enlace al panel de administración para admins --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                        Panel de Administración
                                    </a>
                                @endif

                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    Mis Pedidos
                                </a>
                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01">
                                        </path>
                                    </svg>
                                    Carrito
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form action="{{ route('auth.logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
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
        </div>
    </div>
</nav>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== ANIMACIONES GSAP BÁSICAS =====
        // Solo animaciones de entrada, sin lógica de dropdown
        gsap.fromTo('#mobile-menu-btn, #cart-btn-mobile, #cart-btn-desktop', {
            opacity: 0,
            scale: 0.8
        }, {
            opacity: 1,
            scale: 1,
            duration: 0.5,
            ease: "power2.out",
            stagger: 0.1
        });

        // Efecto hover para botones (excluyendo dropdowns)
        const buttons = document.querySelectorAll('button:not([for]), a');
        buttons.forEach(button => {
            // Verificar que no sea parte de un dropdown de usuario
            if (!button.closest('.group')) {
                button.classList.add('hover:scale-105', 'transition-transform', 'duration-200');
            }
        });
        // ===== CERRAR DROPDOWN AL HACER CLICK FUERA =====
        document.addEventListener('click', function(e) {
            // Si el click no es dentro de un dropdown, cerrar todos los dropdowns
            if (!e.target.closest('.group')) {
                const checkboxes = document.querySelectorAll('.group input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        });
    });
</script>
