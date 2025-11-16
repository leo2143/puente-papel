{{-- Menú móvil deslizable (fuera del header para z-index correcto) --}}
<div id="mobile-navigation" class="fixed inset-0 z-[999999] transform -translate-x-full" aria-hidden="true">

    {{-- Overlay de fondo --}}
    <div class="absolute inset-0 bg-pink-50/50 z-[999998]" id="mobile-overlay"></div>

    {{-- Panel del menú --}}
    <div class="relative w-80 h-screen bg-white shadow-2xl z-[999999]">
        {{-- Header del menú --}}
        <div class="flex items-center justify-between p-6 border-b border-gray-200 z-[999999]">
            <h2 class="text-xl font-bold text-gray-800">Menú</h2>
            <button id="close-mobile-menu" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                aria-label="Cerrar menú">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Perfil de usuario --}}
        <div class="p-6 border-b border-gray-200 z-[999999]">
            @auth
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">{{ auth()->user()->name }} {{ auth()->user()->last_name }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            @else
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-800 font-medium">Invitado</p>
                        <p class="text-sm text-gray-500">No has iniciado sesión</p>
                    </div>
                </div>
            @endauth
        </div>

        {{-- Lista de navegación --}}
        <div class="flex-1 p-6 z-[999999]">
            <ul class="space-y-2">
                {{-- Inicio --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('home') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Inicio</span>
                    </a>
                </li>

                {{-- Productos --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('product.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('product.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Productos</span>
                    </a>
                </li>

                {{-- Blog --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('blog.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('blog.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Blog</span>
                    </a>
                </li>

                {{-- Sobre Nosotros --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('about') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('about') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Acerca de</span>
                    </a>
                </li>

                {{-- Autenticación --}}
                @auth
                    {{-- Desplegable Mi Cuenta --}}
                    <li class="mobile-menu-item">
                        <button id="account-toggle"
                            class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Mi Cuenta</span>
                            </div>
                            <svg id="account-arrow" class="w-4 h-4 transform transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Submenú de cuenta --}}
                        <div id="account-submenu" class="hidden mt-2 ml-6 space-y-1">
                            <a href="{{ route('auth.profile') }}"
                                class="block p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700 {{ request()->routeIs('auth.profile') ? 'bg-red-50 text-red-600' : '' }}">
                                Mi Perfil
                            </a>
                            <a href="#"
                                class="block p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                                Mis Pedidos
                            </a>
                            <a href="#"
                                class="block p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                                Carrito
                            </a>
                        </div>
                    </li>

                    {{-- Ayuda --}}
                    <li class="mobile-menu-item">
                        <a href="#"
                            class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group text-gray-700">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <span class="group-hover:text-red-600 transition-colors duration-200">Ayuda</span>
                        </a>
                    </li>

                    {{-- Servicios (con dropdown) --}}
                    <li class="mobile-menu-item">
                        <button id="services-toggle"
                            class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                    </path>
                                </svg>
                                <span>Servicios</span>
                            </div>
                            <svg id="services-arrow" class="w-4 h-4 transform transition-transform duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        {{-- Submenú de servicios --}}
                        <div id="services-submenu" class="hidden mt-2 ml-6 space-y-1">
                            <a href="{{ route('blog.index') }}"
                                class="block p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                                Blog
                            </a>
                            <a href="#"
                                class="block p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                                Búsqueda bibliográfica
                            </a>
                        </div>
                    </li>

                    {{-- Separador --}}
                    <div class="border-t border-gray-200 my-4"></div>

                    {{-- Panel de Administración para admins --}}
                    @if (auth()->user()->role === 'admin')
                        <li class="mobile-menu-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group {{ request()->routeIs('admin.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <span class="group-hover:text-red-600 transition-colors duration-200 font-medium">Panel de
                                    Administración</span>
                            </a>
                        </li>
                    @endif

                    {{-- Cerrar Sesión --}}
                    <li class="mobile-menu-item">
                        <form action="{{ route('auth.logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group text-left text-red-600">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span class="group-hover:text-red-700 transition-colors duration-200">Cerrar Sesión</span>
                            </button>
                        </form>
                    </li>
                @else
                    {{-- Iniciar Sesión --}}
                    <li class="mobile-menu-item">
                        <a href="{{ route('auth.login.show') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Iniciar
                                Sesión</span>
                        </a>
                    </li>

                    {{-- Registrarse --}}
                    <li class="mobile-menu-item">
                        <a href="{{ route('auth.register.show') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200 group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                            <span>Registrarse</span>
                        </a>
                    </li>
                @endauth

                {{-- Servicios (con dropdown) --}}
                <li class="mobile-menu-item">

                    {{-- Submenú de servicios --}}
                    <div id="services-submenu" class="hidden mt-2 ml-6 space-y-1">
                        <a href="{{ route('blog.index') }}"
                            class="block p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200">
                            Blog
                        </a>
                        <a href="#"
                            class="block p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200">
                            Búsqueda bibliográfica
                        </a>
                    </div>
                </li>

            </ul>
        </div>

        {{-- Elementos decorativos del footer --}}
        <div class="absolute bottom-0 left-0 right-0 h-20 overflow-hidden">
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-purple-300 rounded-full opacity-30"></div>
            <div class="absolute -bottom-5 left-16 w-12 h-12 bg-orange-300 rounded-full opacity-40"></div>
            <div class="absolute -bottom-8 right-20 w-16 h-16 bg-pink-300 rounded-full opacity-35"></div>
            <div class="absolute -bottom-3 right-8 w-8 h-8 bg-purple-400 rounded-full opacity-25"></div>
            <div class="absolute -bottom-6 right-32 w-6 h-6 bg-orange-400 rounded-full opacity-30"></div>
        </div>
    </div>
</div>

<header
    class="bg-secondary-color/30 backdrop-blur-sm backdrop-saturate-150 shadow-lg border-b border-white/20 relative z-50">
    {{-- Navegación principal --}}
    <x-nav />
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables del menú móvil
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileNavigation = document.getElementById('mobile-navigation');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const servicesToggle = document.getElementById('services-toggle');
        const servicesSubmenu = document.getElementById('services-submenu');
        const servicesArrow = document.getElementById('services-arrow');

        // Función para abrir el menú
        function openMobileMenu() {
            mobileNavigation.classList.remove('-translate-x-full');
            mobileNavigation.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden'; // Prevenir scroll del body

            // Animación de entrada del menú
            gsap.fromTo(mobileNavigation, {
                x: -320,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.3,
                ease: "power2.out"
            });

            // Animación de los elementos del menú
            gsap.fromTo('.mobile-menu-item', {
                x: -20,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.4,
                stagger: 0.1,
                ease: "power2.out",
                delay: 0.1
            });
        }

        // Función para cerrar el menú
        function closeMobileMenuFunc() {
            // Animación de salida
            gsap.to(mobileNavigation, {
                x: -320,
                opacity: 0,
                duration: 0.3,
                ease: "power2.out",
                onComplete: () => {
                    // Restaurar estado inicial
                    mobileNavigation.classList.add('-translate-x-full');
                    mobileNavigation.setAttribute('aria-hidden', 'true');
                    document.body.style.overflow = ''; // Restaurar scroll del body

                    // Resetear transformaciones de GSAP para la próxima apertura
                    gsap.set(mobileNavigation, {
                        clearProps: "transform,opacity"
                    });
                }
            });
        }

        // Event listeners
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', function() {
                gsap.to(this, {
                    scale: 0.9,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                openMobileMenu();
            });
        }

        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        }

        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', closeMobileMenuFunc);
        }

        // Funcionalidad del dropdown de servicios
        if (servicesToggle && servicesSubmenu && servicesArrow) {
            servicesToggle.addEventListener('click', function() {
                const isHidden = servicesSubmenu.classList.contains('hidden');

                if (isHidden) {
                    servicesSubmenu.classList.remove('hidden');
                    gsap.to(servicesArrow, {
                        rotation: 180,
                        duration: 0.2
                    });
                    gsap.fromTo(servicesSubmenu.children, {
                        y: -10,
                        opacity: 0
                    }, {
                        y: 0,
                        opacity: 1,
                        duration: 0.3,
                        stagger: 0.1,
                        ease: "power2.out"
                    });
                } else {
                    gsap.to(servicesSubmenu.children, {
                        y: -10,
                        opacity: 0,
                        duration: 0.2,
                        stagger: 0.05,
                        ease: "power2.out"
                    });
                    gsap.to(servicesArrow, {
                        rotation: 0,
                        duration: 0.2
                    });
                    setTimeout(() => {
                        servicesSubmenu.classList.add('hidden');
                    }, 200);
                }
            });
        }

        // Funcionalidad del dropdown de cuenta
        const accountToggle = document.getElementById('account-toggle');
        const accountSubmenu = document.getElementById('account-submenu');
        const accountArrow = document.getElementById('account-arrow');

        if (accountToggle && accountSubmenu && accountArrow) {
            accountToggle.addEventListener('click', function() {
                const isHidden = accountSubmenu.classList.contains('hidden');

                if (isHidden) {
                    accountSubmenu.classList.remove('hidden');
                    gsap.to(accountArrow, {
                        rotation: 180,
                        duration: 0.2
                    });
                    gsap.fromTo(accountSubmenu.children, {
                        y: -10,
                        opacity: 0
                    }, {
                        y: 0,
                        opacity: 1,
                        duration: 0.3,
                        stagger: 0.1,
                        ease: "power2.out"
                    });
                } else {
                    gsap.to(accountSubmenu.children, {
                        y: -10,
                        opacity: 0,
                        duration: 0.2,
                        stagger: 0.05,
                        ease: "power2.out"
                    });
                    gsap.to(accountArrow, {
                        rotation: 0,
                        duration: 0.2
                    });
                    setTimeout(() => {
                        accountSubmenu.classList.add('hidden');
                    }, 200);
                }
            });
        }

        // Cerrar menú con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileNavigation.classList.contains('-translate-x-full')) {
                closeMobileMenuFunc();
            }
        });

        // Animación del botón carrito
        const cartBtn = document.getElementById('cart-btn');
        if (cartBtn) {
            cartBtn.addEventListener('click', function() {
                gsap.to(this, {
                    scale: 0.9,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                // Aquí después agregaremos la funcionalidad del carrito
                console.log('Carrito clickeado');
            });
        }

        // Animación de entrada para el header
        gsap.fromTo('header', {
            opacity: 0,
            y: -20
        }, {
            opacity: 1,
            y: 0,
            duration: 0.6,
            ease: "power2.out",
            clearProps: "transform,opacity" // Limpiar propiedades después de la animación
        });
    });
</script>
