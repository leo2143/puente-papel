<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Admin' }} - Puente Papel</title>
    <link rel="stylesheet" href="<?= url('css/styles.css') ?>">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            height: 100%;
        }
    </style>
</head>

<body class="h-full relative">
    {{-- Canvas para ThpaceGL - Fondo de toda la página --}}
    <canvas id="make-me-cool" class="fixed inset-0 w-full h-full z-0"></canvas>

    <div id="app" class="relative z-10 h-full">
        {{-- Header Admin Desplegable --}}
        <x-admin-header />
        <main class="h-full">
            <div class="flex h-full">
                {{-- Sidebar (oculto en móvil, colapsable en desktop) --}}
                <aside id="admin-sidebar" class="hidden lg:flex lg:flex-col w-64 bg-white shadow-lg border-r border-gray-200 relative z-40 transition-all duration-300 ease-in-out h-screen">
                    {{-- Header del sidebar con botón toggle --}}
                    <div class="flex items-center justify-between p-4 border-b border-gray-200 flex-shrink-0">
                        <h2 class="text-lg font-semibold text-gray-800 sidebar-text">Panel Admin</h2>
                        <button id="sidebar-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200" 
                                aria-label="Colapsar sidebar">
                            <svg class="w-5 h-5 text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <nav class="flex-1 overflow-y-auto">
                        <div class="px-4 py-4 space-y-2">
                            {{-- Dashboard --}}
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}"
                                title="Dashboard">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                </svg>
                                <span class="sidebar-text">Dashboard</span>
                            </a>

                            {{-- Productos --}}
                            <a href="{{ route('admin.product.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.product.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}"
                                title="Productos">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span class="sidebar-text">Productos</span>
                            </a>

                            {{-- Blog --}}
                            <a href="{{ route('admin.blog.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.blog.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}"
                                title="Blog">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                                <span class="sidebar-text">Blog</span>
                            </a>

                            {{-- Usuarios --}}
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}"
                                title="Usuarios">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                                <span class="sidebar-text">Usuarios</span>
                            </a>

                            {{-- Separador --}}
                            <div class="border-t border-gray-200 my-4"></div>

                            {{-- Volver al sitio --}}
                            <a href="{{ route('home') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                                title="Volver al sitio">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span class="sidebar-text">Volver al sitio</span>
                            </a>
                        </div>
                    </nav>
                </aside>

                {{-- Contenido principal --}}
                <main class="flex-1 overflow-y-auto relative z-10 h-screen">
                    <div class="p-4 lg:p-8 min-h-full">
                        {{-- Breadcrumbs --}}
                        @if (isset($breadcrumbs))
                            <nav class="mb-4 lg:mb-6">
                                <ol class="flex items-center space-x-1 lg:space-x-2 text-xs lg:text-sm text-gray-600 overflow-x-auto">
                                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-red-600">Admin</a>
                                    </li>
                                    @foreach ($breadcrumbs as $breadcrumb)
                                        <li class="flex items-center space-x-1 lg:space-x-2 whitespace-nowrap">
                                            <svg class="w-3 h-3 lg:w-4 lg:h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            @if ($breadcrumb['active'])
                                                <span class="text-red-600 font-medium">{{ $breadcrumb['name'] }}</span>
                                            @else
                                                <a href="{{ $breadcrumb['url'] }}"
                                                    class="hover:text-red-600">{{ $breadcrumb['name'] }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </nav>
                        @endif

                        {{-- Contenido --}}
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </main>
    </div>

    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables del sidebar
        const sidebar = document.getElementById('admin-sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const mainContent = document.querySelector('main > div > main');
        
        // Estado del sidebar (por defecto expandido)
        let isCollapsed = false;
        
        // Función para colapsar/expandir sidebar (global)
        window.toggleAdminSidebar = function() {
            isCollapsed = !isCollapsed;
            
            if (isCollapsed) {
                // Colapsar sidebar
                sidebar.style.width = '4rem';
                sidebarTexts.forEach(text => {
                    text.style.opacity = '0';
                    text.style.visibility = 'hidden';
                });
                
                // Rotar ícono
                sidebarToggle.querySelector('svg').style.transform = 'rotate(180deg)';
                
                // Ajustar contenido principal
                mainContent.style.marginLeft = '4rem';
                
                // Guardar estado en localStorage
                localStorage.setItem('admin-sidebar-collapsed', 'true');
                
                // Mostrar botón expandir en header
                const expandBtn = document.getElementById('expand-sidebar-btn');
                if (expandBtn) {
                    expandBtn.style.display = 'block';
                }
            } else {
                // Expandir sidebar
                sidebar.style.width = '16rem';
                sidebarTexts.forEach(text => {
                    text.style.opacity = '1';
                    text.style.visibility = 'visible';
                });
                
                // Rotar ícono
                sidebarToggle.querySelector('svg').style.transform = 'rotate(0deg)';
                
                // Ajustar contenido principal
                mainContent.style.marginLeft = '0';
                
                // Guardar estado en localStorage
                localStorage.setItem('admin-sidebar-collapsed', 'false');
                
                // Ocultar botón expandir en header
                const expandBtn = document.getElementById('expand-sidebar-btn');
                if (expandBtn) {
                    expandBtn.style.display = 'none';
                }
            }
        }
        
        // Event listener para el botón toggle
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                gsap.to(this, {
                    scale: 0.9,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 1
                });
                toggleSidebar();
            });
        }
        
        // Restaurar estado del sidebar al cargar la página
        const savedState = localStorage.getItem('admin-sidebar-collapsed');
        if (savedState === 'true') {
            // Aplicar estado colapsado
            sidebar.style.width = '4rem';
            sidebarTexts.forEach(text => {
                text.style.opacity = '0';
                text.style.visibility = 'hidden';
            });
            sidebarToggle.querySelector('svg').style.transform = 'rotate(180deg)';
            mainContent.style.marginLeft = '4rem';
            isCollapsed = true;
            
            // Mostrar botón expandir en header
            const expandBtn = document.getElementById('expand-sidebar-btn');
            if (expandBtn) {
                expandBtn.style.display = 'block';
            }
        } else {
            // Ocultar botón expandir en header si está expandido
            const expandBtn = document.getElementById('expand-sidebar-btn');
            if (expandBtn) {
                expandBtn.style.display = 'none';
            }
        }
        
        // Agregar transiciones suaves a los textos
        sidebarTexts.forEach(text => {
            text.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';
        });
        
        // Ajustar contenido principal con transición
        mainContent.style.transition = 'margin-left 0.3s ease';
    });
    </script>
</body>

</html>
