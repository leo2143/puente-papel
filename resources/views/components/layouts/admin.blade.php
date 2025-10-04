<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Admin' }} :: Puente Papel</title>
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
        {{-- Header Admin --}}
        <header class="bg-white shadow-lg border-b border-gray-200 relative z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    {{-- Logo y título --}}
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}"
                            class="text-2xl font-bold text-gray-800 hover:text-red-600 transition-colors duration-200">
                            Puente Papel
                        </a>
                        <span class="text-gray-400">|</span>
                        <h1 class="text-xl font-semibold text-gray-700">Panel de Administración</h1>
                    </div>

                    {{-- Usuario y logout --}}
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Bienvenido, {{ auth()->user()->name }}</span>
                        <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-red-600 hover:text-red-700 text-sm font-medium transition-colors duration-200">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="flex h-full">
                {{-- Sidebar --}}
                <aside class="w-64 bg-white shadow-lg border-r border-gray-200 relative z-40">
                    <nav class="mt-8">
                        <div class="px-4 space-y-2">
                            {{-- Dashboard --}}
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>

                            {{-- Productos --}}
                            <a href="{{ route('admin.product.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.product.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                <span>Productos</span>
                            </a>

                            {{-- Blog --}}
                            <a href="{{ route('admin.blog.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.blog.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                    </path>
                                </svg>
                                <span>Blog</span>
                            </a>

                            {{-- Usuarios --}}
                            <a href="{{ route('admin.users.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-red-50 text-red-600 border-r-2 border-red-600' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                    </path>
                                </svg>
                                <span>Usuarios</span>
                            </a>

                            {{-- Separador --}}
                            <div class="border-t border-gray-200 my-4"></div>

                            {{-- Volver al sitio --}}
                            <a href="{{ route('home') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Volver al sitio</span>
                            </a>
                        </div>
                    </nav>
                </aside>

                {{-- Contenido principal --}}
                <main class="flex-1 overflow-y-auto relative z-10">
                    <div class="p-8">
                        {{-- Breadcrumbs --}}
                        @if (isset($breadcrumbs))
                            <nav class="mb-6">
                                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-red-600">Admin</a>
                                    </li>
                                    @foreach ($breadcrumbs as $breadcrumb)
                                        <li class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
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
</body>

</html>
