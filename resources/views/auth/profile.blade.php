<x-layouts.main>
    <x-slot:title>Mi Perfil</x-slot:title>

    {{-- Breadcrumbs --}}
    @php
        $breadcrumbs = [
            ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
            ['name' => 'Mi Perfil', 'url' => '#', 'active' => true],
        ];
    @endphp

    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-2xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mi Perfil</h1>

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

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-800 mb-2">
                                Nombre
                            </label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-800 mb-2">
                                Apellido
                            </label>
                            <input type="text" name="last_name" id="last_name"
                                value="{{ old('last_name', $user->last_name) }}"
                                class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-800 mb-2">
                            Correo electrónico
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-800 mb-2">
                            Teléfono
                        </label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                    </div>

                    <div class="bg-pink-100 px-4 py-3 rounded-xl border-2 border-pink-300">
                        <h3 class="text-sm font-medium text-gray-800 mb-2">Información adicional</h3>
                        <div class="space-y-2">
                            <div>
                                <span class="text-sm text-gray-600">Rol:</span>
                                <span
                                    class="ml-2 text-sm font-medium text-gray-800 capitalize">{{ $user->role }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Estado:</span>
                                <span
                                    class="ml-2 text-sm font-medium {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-600">Miembro desde:</span>
                                <span class="ml-2 text-sm font-medium text-gray-800">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 space-y-3">
                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg">
                            Actualizar Perfil
                        </button>
                        <a href="{{ route('home') }}"
                            class="w-full bg-pink-100 hover:bg-pink-200 text-gray-800 font-medium py-3 px-6 rounded-xl transition-all duration-300 border-2 border-pink-300 text-center block">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada
            gsap.fromTo('.bg-pink-50', {
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
