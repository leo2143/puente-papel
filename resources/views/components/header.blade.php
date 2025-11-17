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
                <img src="{{ asset('storage/icons-svg/close.svg') }}" alt="" class="w-6 h-6 text-gray-600" aria-hidden="true">
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
                        <img src="{{ asset('storage/icons-svg/user.svg') }}" alt="" class="w-6 h-6 text-gray-600" aria-hidden="true">
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
                        <img src="{{ asset('storage/icons-svg/home.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                        <span class="group-hover:text-red-600 transition-colors duration-200">Inicio</span>
                    </a>
                </li>

                {{-- Productos --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('product.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('product.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <img src="{{ asset('storage/icons-svg/shopping-bag.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                        <span class="group-hover:text-red-600 transition-colors duration-200">Productos</span>
                    </a>
                </li>

                {{-- Blog --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('blog.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('blog.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <img src="{{ asset('storage/icons-svg/newspaper.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                        <span class="group-hover:text-red-600 transition-colors duration-200">Blog</span>
                    </a>
                </li>

                {{-- Sobre Nosotros --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('about') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group {{ request()->routeIs('about') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <img src="{{ asset('storage/icons-svg/user.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
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
                                <img src="{{ asset('storage/icons-svg/user.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                                <span>Mi Cuenta</span>
                            </div>
                            <img src="{{ asset('storage/icons-svg/chevron-down.svg') }}" alt="" id="account-arrow" class="w-4 h-4 transform transition-transform duration-200">
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
                            <img src="{{ asset('storage/icons-svg/question-circle.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                            <span class="group-hover:text-red-600 transition-colors duration-200">Ayuda</span>
                        </a>
                    </li>

                    {{-- Servicios (con dropdown) --}}
                    <li class="mobile-menu-item">
                        <button id="services-toggle"
                            class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-700">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('storage/icons-svg/star.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                                <span>Servicios</span>
                            </div>
                            <img src="{{ asset('storage/icons-svg/chevron-down.svg') }}" alt="" id="services-arrow" class="w-4 h-4 transform transition-transform duration-200">
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
                                <img src="{{ asset('storage/icons-svg/shield-check.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
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
                                <img src="{{ asset('storage/icons-svg/logout.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                                <span class="group-hover:text-red-700 transition-colors duration-200">Cerrar Sesión</span>
                            </button>
                        </form>
                    </li>
                @else
                    {{-- Iniciar Sesión --}}
                    <li class="mobile-menu-item">
                        <a href="{{ route('auth.login.show') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                            <img src="{{ asset('storage/icons-svg/login.svg') }}" alt="" class="w-5 h-5 text-red-600" aria-hidden="true">
                            <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Iniciar
                                Sesión</span>
                        </a>
                    </li>

                    {{-- Registrarse --}}
                    <li class="mobile-menu-item">
                        <a href="{{ route('auth.register.show') }}"
                            class="flex items-center space-x-3 p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200 group">
                            <img src="{{ asset('storage/icons-svg/user-plus.svg') }}" alt="" class="w-5 h-5" aria-hidden="true">
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
    });
</script>
