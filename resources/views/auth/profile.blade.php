<x-layouts.main>
    <x-slot:title>Mi Perfil - Puente Papel</x-slot:title>

    {{-- Breadcrumbs --}}
    @php
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
            ['name' => 'Mi Perfil', 'url' => '#', 'active' => true],
        ];
    @endphp

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Mi Perfil</h1>

                {{-- Mostrar mensajes de éxito --}}
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Mostrar mensajes de error --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('auth.profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nombre
                            </label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Apellido
                            </label>
                            <div class="mt-1">
                                <input type="text" name="last_name" id="last_name"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Correo electrónico
                        </label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">
                            Teléfono
                        </label>
                        <div class="mt-1">
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 rounded-md">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Información adicional</h3>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <span class="text-sm text-gray-500">Rol:</span>
                                <span
                                    class="ml-2 text-sm font-medium text-gray-900 capitalize">{{ $user->role }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Estado:</span>
                                <span
                                    class="ml-2 text-sm font-medium {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Miembro desde:</span>
                                <span class="ml-2 text-sm font-medium text-gray-900">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('home') }}"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Actualizar Perfil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada
            gsap.fromTo('.bg-white', {
                opacity: 0,
                y: 30
            }, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power2.out"
            });
        });
    </script>
</x-layouts.main>
