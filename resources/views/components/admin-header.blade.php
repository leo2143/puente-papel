{{-- Menú móvil deslizable para Admin (fuera del header para z-index correcto) --}}
<div id="admin-mobile-navigation" class="fixed inset-0 z-[999999] transform -translate-x-full" aria-hidden="true">

    {{-- Overlay de fondo --}}
    <div class="absolute inset-0 bg-gray-900/50 z-[999998]" id="admin-mobile-overlay"></div>

    {{-- Panel del menú --}}
    <div class="relative w-80 h-screen bg-white shadow-2xl z-[999999]">
        {{-- Header del menú --}}
        <div class="flex items-center justify-between p-6 border-b border-gray-200 z-[999999]">
            <h2 class="text-xl font-bold text-gray-800">Panel Admin</h2>
            <button id="close-admin-mobile-menu" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                aria-label="Cerrar menú">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        {{-- Perfil de usuario admin --}}
        <div class="p-6 border-b border-gray-200 z-[999999]">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-medium">
                        {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name ?? '', 0, 1) }}
                    </span>
                </div>
                <div>
                    <p class="text-gray-800 font-medium">{{ auth()->user()->name }} {{ auth()->user()->last_name ?? '' }}</p>
                    <p class="text-sm text-red-600 font-medium">Administrador</p>
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Lista de navegación admin --}}
        <div class="flex-1 p-6 z-[999999]">
            <ul class="space-y-2">
                {{-- Dashboard --}}
                <li class="admin-mobile-menu-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Dashboard</span>
                    </a>
                </li>

                {{-- Productos --}}
                <li class="admin-mobile-menu-item">
                    <a href="{{ route('admin.product.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group {{ request()->routeIs('admin.product.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Productos</span>
                    </a>
                </li>

                {{-- Blog --}}
                <li class="admin-mobile-menu-item">
                    <a href="{{ route('admin.blog.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group {{ request()->routeIs('admin.blog.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Blog</span>
                    </a>
                </li>

                {{-- Usuarios --}}
                <li class="admin-mobile-menu-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600' : 'text-gray-700' }}">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span class="group-hover:text-red-600 transition-colors duration-200">Usuarios</span>
                    </a>
                </li>

                {{-- Separador --}}
                <div class="border-t border-gray-200 my-4"></div>

                {{-- Volver al sitio --}}
                <li class="admin-mobile-menu-item">
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group text-gray-600">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span class="group-hover:text-gray-800 transition-colors duration-200">Volver al sitio</span>
                    </a>
                </li>

                {{-- Cerrar Sesión --}}
                <li class="admin-mobile-menu-item">
                    <form action="{{ route('auth.logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 transition-colors duration-200 group text-left text-red-600">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            <span class="group-hover:text-red-700 transition-colors duration-200">Cerrar Sesión</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        {{-- Elementos decorativos del footer --}}
        <div class="absolute bottom-0 left-0 right-0 h-20 overflow-hidden">
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-red-300 rounded-full opacity-20"></div>
            <div class="absolute -bottom-5 left-16 w-12 h-12 bg-red-400 rounded-full opacity-25"></div>
            <div class="absolute -bottom-8 right-20 w-16 h-16 bg-red-300 rounded-full opacity-20"></div>
            <div class="absolute -bottom-3 right-8 w-8 h-8 bg-red-400 rounded-full opacity-30"></div>
            <div class="absolute -bottom-6 right-32 w-6 h-6 bg-red-500 rounded-full opacity-25"></div>
        </div>
    </div>
</div>

<header class="bg-secondary-color/30 backdrop-blur-sm backdrop-saturate-150 shadow-lg border-b border-white/20 relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            {{-- Logo, título y botones --}}
            <div class="flex items-center space-x-4">
                {{-- Botón menú móvil --}}
                <button id="admin-mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-white/20 transition-colors duration-200"
                    aria-label="Abrir menú">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>

                {{-- Botón expandir sidebar (solo desktop) --}}
                <button id="expand-sidebar-btn" class="hidden lg:block p-2 rounded-lg hover:bg-white/20 transition-colors duration-200"
                    aria-label="Expandir sidebar">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>

                {{-- Logo y título --}}
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-bold text-gray-800 hover:text-red-600 transition-colors duration-200">
                        Puente Papel
                    </a>
                    <span class="text-gray-400 hidden sm:block">|</span>
                    <h1 class="text-xl font-semibold text-gray-700 hidden sm:block">Panel de Administración</h1>
                    <span class="lg:hidden text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full font-medium">Admin</span>
                </div>
            </div>

            {{-- Usuario y logout (desktop) --}}
            <div class="hidden lg:flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-medium">
                            {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name ?? '', 0, 1) }}
                        </span>
                    </div>
                    <span class="text-sm text-gray-600">Bienvenido, {{ auth()->user()->name }}</span>
                </div>
                <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-red-600 hover:text-red-700 text-sm font-medium transition-colors duration-200">
                        Cerrar Sesión
                    </button>
                </form>
            </div>

            {{-- Botón de usuario móvil --}}
            <div class="lg:hidden">
                <button id="admin-user-menu-btn" class="p-2 rounded-lg hover:bg-white/20 transition-colors duration-200"
                    aria-label="Menú de usuario">
                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-xs font-medium">
                            {{ substr(auth()->user()->name, 0, 1) }}{{ substr(auth()->user()->last_name ?? '', 0, 1) }}
                        </span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variables del menú móvil admin
    const adminMobileMenuBtn = document.getElementById('admin-mobile-menu-btn');
    const adminMobileNavigation = document.getElementById('admin-mobile-navigation');
    const closeAdminMobileMenu = document.getElementById('close-admin-mobile-menu');
    const adminMobileOverlay = document.getElementById('admin-mobile-overlay');
    const adminUserMenuBtn = document.getElementById('admin-user-menu-btn');
    const expandSidebarBtn = document.getElementById('expand-sidebar-btn');

    // Función para abrir el menú admin
    function openAdminMobileMenu() {
        adminMobileNavigation.classList.remove('-translate-x-full');
        adminMobileNavigation.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden'; // Prevenir scroll del body

        // Animación de entrada del menú
        gsap.fromTo(adminMobileNavigation, {
            x: -320,
            opacity: 0
        }, {
            x: 0,
            opacity: 1,
            duration: 0.3,
            ease: "power2.out"
        });

        // Animación de los elementos del menú
        gsap.fromTo('.admin-mobile-menu-item', {
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

    // Función para cerrar el menú admin
    function closeAdminMobileMenuFunc() {
        // Animación de salida
        gsap.to(adminMobileNavigation, {
            x: -320,
            opacity: 0,
            duration: 0.3,
            ease: "power2.out",
            onComplete: () => {
                // Restaurar estado inicial
                adminMobileNavigation.classList.add('-translate-x-full');
                adminMobileNavigation.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = ''; // Restaurar scroll del body

                // Resetear transformaciones de GSAP para la próxima apertura
                gsap.set(adminMobileNavigation, {
                    clearProps: "transform,opacity"
                });
            }
        });
    }

    // Event listeners
    if (adminMobileMenuBtn) {
        adminMobileMenuBtn.addEventListener('click', function() {
            gsap.to(this, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });
            openAdminMobileMenu();
        });
    }

    if (closeAdminMobileMenu) {
        closeAdminMobileMenu.addEventListener('click', closeAdminMobileMenuFunc);
    }

    if (adminMobileOverlay) {
        adminMobileOverlay.addEventListener('click', closeAdminMobileMenuFunc);
    }

    // Botón de usuario móvil (abre el mismo menú)
    if (adminUserMenuBtn) {
        adminUserMenuBtn.addEventListener('click', function() {
            gsap.to(this, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });
            openAdminMobileMenu();
        });
    }

    // Botón expandir sidebar (solo desktop)
    if (expandSidebarBtn) {
        expandSidebarBtn.addEventListener('click', function() {
            gsap.to(this, {
                scale: 0.9,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });
            
            // Llamar a la función toggleSidebar del layout admin
            if (window.toggleAdminSidebar) {
                window.toggleAdminSidebar();
            }
        });
    }

    // Cerrar menú con tecla Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !adminMobileNavigation.classList.contains('-translate-x-full')) {
            closeAdminMobileMenuFunc();
        }
    });

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
