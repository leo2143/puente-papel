{{-- Menú móvil deslizable (fuera del header para z-index correcto) --}}
<div id="mobile-navigation" 
     class="fixed inset-0 z-[999999] transform -translate-x-full"
     aria-hidden="true">
    
    {{-- Overlay de fondo --}}
    <div class="absolute inset-0 bg-pink-50 bg-opacity-80 z-[999998]" id="mobile-overlay"></div>
    
    {{-- Panel del menú --}}
    <div class="relative w-80 h-screen bg-white shadow-2xl z-[999999]">
        {{-- Header del menú --}}
        <div class="flex items-center justify-between p-6 border-b border-gray-200 z-[999999]">
            <h2 class="text-xl font-bold text-gray-800">Menú</h2>
            <button id="close-mobile-menu" 
                    class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                    aria-label="Cerrar menú">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Perfil de usuario --}}
        <div class="p-6 border-b border-gray-200 z-[999999]">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-gray-800 font-medium">Nombre de usuario</p>
                    <p class="text-sm text-gray-500">Usuario registrado</p>
                </div>
            </div>
        </div>

        {{-- Lista de navegación --}}
        <div class="flex-1 p-6 z-[999999]">
            <ul class="space-y-2">
                {{-- Inicio --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('home') }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Inicio</span>
                    </a>
                </li>

                {{-- Productos --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('products.index') }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Productos</span>
                    </a>
                </li>

                {{-- Sobre Nosotros --}}
                <li class="mobile-menu-item">
                    <a href="{{ route('about') }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Sobre Nosotros</span>
                    </a>
                </li>

                {{-- Servicios (con dropdown) --}}
                <li class="mobile-menu-item">
                    <button id="services-toggle" 
                            class="w-full flex items-center justify-between p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            <span>Servicios</span>
                        </div>
                        <svg id="services-arrow" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    {{-- Submenú de servicios --}}
                    <div id="services-submenu" class="hidden mt-2 ml-6 space-y-1">
                        <a href="#" class="block p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200">
                            Blog
                        </a>
                        <a href="#" class="block p-3 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors duration-200">
                            Búsqueda bibliográfica
                        </a>
                    </div>
                </li>

                {{-- Ayuda --}}
                <li class="mobile-menu-item">
                    <a href="#" 
                       class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Ayuda</span>
                    </a>
                </li>

                {{-- Cerrar Sesión --}}
                <li class="mobile-menu-item">
                    <a href="#" 
                       class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="text-gray-800 group-hover:text-red-600 transition-colors duration-200">Cerrar Sesión</span>
                    </a>
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

<header class="bg-secondary-color/30 backdrop-blur-sm backdrop-saturate-150 shadow-lg border-b border-white/20">
    {{-- Barra superior oscura --}}

    {{-- Navegación principal --}}
    <x-nav />

    {{-- Breadcrumbs --}}
    <x-breadcrumbs />
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
            gsap.fromTo(mobileNavigation, 
                { x: -320, opacity: 0 },
                { x: 0, opacity: 1, duration: 0.3, ease: "power2.out" }
            );
            
            // Animación de los elementos del menú
            gsap.fromTo('.mobile-menu-item', 
                { x: -20, opacity: 0 },
                { x: 0, opacity: 1, duration: 0.4, stagger: 0.1, ease: "power2.out", delay: 0.1 }
            );
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
                    gsap.set(mobileNavigation, { clearProps: "transform,opacity" });
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
                    gsap.to(servicesArrow, { rotation: 180, duration: 0.2 });
                    gsap.fromTo(servicesSubmenu.children, 
                        { y: -10, opacity: 0 },
                        { y: 0, opacity: 1, duration: 0.3, stagger: 0.1, ease: "power2.out" }
                    );
                } else {
                    gsap.to(servicesSubmenu.children, 
                        { y: -10, opacity: 0, duration: 0.2, stagger: 0.05, ease: "power2.out" }
                    );
                    gsap.to(servicesArrow, { rotation: 0, duration: 0.2 });
                    setTimeout(() => {
                        servicesSubmenu.classList.add('hidden');
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