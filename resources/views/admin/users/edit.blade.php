<x-layouts.admin>
    <x-slot:title>Editar Usuario</x-slot:title>

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Editar Usuario</h2>
            <p class="text-gray-600 mt-2">Modifica la información del usuario</p>
        </div>
        <a href="{{ route('admin.users.index') }}"
            class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            <span>Volver al listado</span>
        </a>
    </div>

    {{-- Formulario --}}
    <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-2xl mx-auto">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Nombre --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-800 mb-2">
                        Nombre *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        placeholder="Nombre del usuario..." required>
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Apellido --}}
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-800 mb-2">
                        Apellido
                    </label>
                    <input type="text" id="last_name" name="last_name"
                        value="{{ old('last_name', $user->last_name) }}"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        placeholder="Apellido del usuario...">
                    @error('last_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-800 mb-2">
                        Correo Electrónico *
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        placeholder="usuario@ejemplo.com" required>
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-800 mb-2">
                        Teléfono
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        placeholder="+1 (555) 123-4567">
                    @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nueva contraseña --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-800 mb-2">
                        Nueva Contraseña
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        placeholder="Mínimo 8 caracteres (deja en blanco si no quieres cambiar)">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-800 mb-2">
                        Confirmar Nueva Contraseña
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300"
                        placeholder="Repite la nueva contraseña">
                </div>

                {{-- Rol --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-800 mb-2">
                        Rol *
                    </label>
                    <select id="role" name="role"
                        class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                        <option value="user" {{ old('role', $user->role ?? 'user') == 'user' ? 'selected' : '' }}>
                            Usuario</option>
                        <option value="admin" {{ old('role', $user->role ?? 'user') == 'admin' ? 'selected' : '' }}>
                            Administrador
                        </option>
                    </select>
                    @error('role')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Estado --}}
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Usuario activo</span>
                    </label>
                    @error('is_active')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Acciones --}}
                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg">
                        Actualizar Usuario
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>
