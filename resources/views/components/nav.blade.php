{{-- Navegación principal --}}
<nav class="px-4 py-3 relative" role="navigation" aria-label="Navegación principal">
    <div class="max-w-7xl mx-auto">

        {{-- Layout móvil (como estaba originalmente) --}}
        <div class="flex items-center justify-between md:hidden">
            {{-- Botón hamburguesa --}}
            <button id="mobile-menu-btn" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                aria-label="Abrir menú de navegación" aria-expanded="false" aria-controls="mobile-navigation">
                <img src="{{ asset('storage/icons-svg/menu-hamburger.svg') }}" alt="Abrir menú" title="Abrir menú"
                    class="w-6 h-6 text-gray-800">
            </button>

            {{-- Barra de búsqueda móvil --}}
            <div class="flex-1 mx-4">
                <div class="relative">
                    <label for="search-input-mobile" class="sr-only">Buscar</label>
                    <input type="text" id="search-input-mobile" placeholder="Buscar"
                        class="w-full px-4 py-2 pr-10 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        aria-label="Campo de búsqueda">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <img src="{{ asset('storage/icons-svg/search.svg') }}" alt="Buscar" title="Buscar"
                            class="w-5 h-5 text-red-600">
                    </div>
                </div>
            </div>

            {{-- Botones de acción móvil --}}
            <a href="{{ route('cart.index') }}" class="flex items-center space-x-2">
                {{-- Botón carrito móvil --}}
                <button id="cart-btn-mobile" class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                    aria-label="Abrir carrito de compras" aria-expanded="false" aria-controls="cart-sidebar">
                    <img src="{{ asset('storage/icons-svg/shopping-cart.svg') }}" alt="Carrito de compras"
                        title="Carrito de compras" class="w-10 h-10 text-red-600">
                </button>
            </a>
        </div>

        {{-- Layout desktop (barra de búsqueda arriba, navegación abajo) --}}
        <div class="hidden md:block">
            {{-- Barra de búsqueda desktop (arriba) --}}
            {{-- Logo --}}

            <div class="mb-4 flex items-center">
                <a href="{{ route('home') }}"
                    class="flex items-center text-2xl font-bold text-gray-800 hover:text-red-600 transition-colors duration-200">
                    <img src="{{ asset('storage/images/puente_papel_icon.png') }}" alt="Puente Papel"
                        class="w-16 h-12 mr-2">
                </a>
                <div class="relative max-w-2xl mx-auto">
                    <label for="search-input-desktop" class="sr-only">Buscar</label>
                    <input type="text" id="search-input-desktop" placeholder="Buscar productos, artículos..."
                        class="w-full px-6 py-3 pr-12 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 text-lg transition-all duration-300"
                        aria-label="Campo de búsqueda">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                        <img src="{{ asset('storage/icons-svg/search.svg') }}" alt="Buscar" title="Buscar"
                            class="w-6 h-6 text-red-600">
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
                    <a href="{{ route('cart.index') }}" id="cart-btn-desktop"
                        class="p-2 rounded-lg hover:bg-gray-200 transition-colors duration-200"
                        aria-label="Abrir carrito de compras" aria-expanded="false" aria-controls="cart-sidebar">
                        <img src="{{ asset('storage/icons-svg/shopping-cart.svg') }}" alt="Carrito de compras"
                            title="Carrito de compras" class="w-10 h-10 text-red-600">
                    </a>

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
                                <img src="{{ asset('storage/icons-svg/chevron-down.svg') }}"
                                    alt="Desplegar menú de usuario" title="Desplegar menú de usuario"
                                    class="w-4 h-4 text-gray-500 transition-transform duration-200 peer-checked:rotate-180">
                            </label>

                            {{-- Dropdown menu --}}
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200 opacity-0 invisible scale-95 -translate-y-2 transition-all duration-200 ease-out peer-checked:opacity-100 peer-checked:visible peer-checked:scale-100 peer-checked:translate-y-0">

                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}
                                        {{ auth()->user()->last_name }}</p>
                                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                                </div>

                                <a href="{{ route('auth.profile') }}"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <img src="{{ asset('storage/icons-svg/user.svg') }}" alt="Mi Perfil"
                                        title="Mi Perfil" class="w-4 h-4 mr-2">
                                    Mi Perfil
                                </a>

                                {{-- Enlace al panel de administración para admins --}}
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <img src="{{ asset('storage/icons-svg/shield-check.svg') }}"
                                            alt="Panel de Administración" title="Panel de Administración"
                                            class="w-4 h-4 mr-2">
                                        Panel de Administración
                                    </a>
                                @endif

                                <a href="#"
                                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <img src="{{ asset('storage/icons-svg/clipboard.svg') }}" alt="Mis Pedidos"
                                        title="Mis Pedidos" class="w-4 h-4 mr-2">
                                    Mis Pedidos
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <form action="{{ route('auth.logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <img src="{{ asset('storage/icons-svg/logout.svg') }}" alt="Cerrar Sesión"
                                            title="Cerrar Sesión" class="w-4 h-4 mr-2">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        {{-- Usuario no autenticado --}}
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('auth.login.show') }}"
                                class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-red-600 transition-colors duration-200">
                                Iniciar Sesión
                            </a>
                            <a href="{{ route('auth.register.show') }}"
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
        // ===== CERRAR DROPDOWN AL HACER CLICK FUERA =====
        document.addEventListener('click', function(e) {
            // NO interferir con enlaces de navegación
            const clickedLink = e.target.closest('a[href]');
            if (clickedLink && clickedLink.getAttribute('href') &&
                clickedLink.getAttribute('href') !== '#' &&
                !clickedLink.getAttribute('href').startsWith('#')) {
                // Es un enlace válido, permitir navegación normal
                return;
            }

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
