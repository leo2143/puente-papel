<x-layouts.main>
    <x-slot:title>Registrarse</x-slot:title>
    <?php
    $backgroundImage = asset('storage/images/utils/hero.jpg'); ?>

    <div class="min-h-screen bg-gray-50/20 flex justify-center items-center">

        <div class="flex flex-row w-full max-w-7xl mx-auto">
            {{-- Imagen - solo visible en desktop, ocupa 50% --}}
            <div class="hidden md:flex md:w-1/2 items-center justify-center">
                <img class="w-full h-full object-cover" src="{{ $backgroundImage }}" alt="Puente Papel" />
            </div>

            {{-- Formulario - ocupa 100% en móvil, 50% en desktop --}}
            <div
                class="w-full md:w-1/2 bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 flex items-center justify-center">
                <div class="w-full max-w-md">
                    <div class="p-5 text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Crear Cuenta</h2>
                        <p class="text-gray-600">Únete a la comunidad de Puente Papel</p>
                    </div>
                    {{-- Mostrar mensajes de éxito --}}
                    @if (session('feedback.message'))
                        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                            {!! session('feedback.message') !!}
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('auth.register.process') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Nombre
                                </label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" autocomplete="given-name"
                                        required value="{{ old('name') }}"
                                        class="appearance-none block w-full px-3 py-2 border @error('name') border-red-300 @else border-gray-300 @enderror rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700">
                                    Apellido
                                </label>
                                <div class="mt-1">
                                    <input id="last_name" name="last_name" type="text" autocomplete="family-name"
                                        required value="{{ old('last_name') }}"
                                        class="appearance-none block w-full px-3 py-2 border @error('last_name') border-red-300 @else border-gray-300 @enderror rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                                </div>
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Correo electrónico
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}"
                                    class="appearance-none block w-full px-3 py-2 border @error('email') border-red-300 @else border-gray-300 @enderror rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">
                                Teléfono
                            </label>
                            <div class="mt-1">
                                <input id="phone" name="phone" type="tel" autocomplete="tel" required
                                    value="{{ old('phone') }}"
                                    class="appearance-none block w-full px-3 py-2 border @error('phone') border-red-300 @else border-gray-300 @enderror rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            </div>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Contraseña
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border @error('password') border-red-300 @else border-gray-300 @enderror rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirmar contraseña
                            </label>
                            <div class="mt-1">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    autocomplete="new-password" required
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-900">
                                Acepto los <a href="#" class="text-red-600 hover:text-red-500">términos y
                                    condiciones</a>
                            </label>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                Crear Cuenta
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('auth.login.show') }}"
                        class="my-5 w-full flex justify-center py-2 px-4  text-sm font-medium text-gray-700  hover:text-red-600 transition-colors duration-200">
                        ¿Ya tienes cuenta? Inicia Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animación de entrada rápida
            gsap.fromTo('.bg-white', {
                opacity: 0,
                y: 10
            }, {
                opacity: 1,
                y: 0,
                duration: 0.2,
                ease: "power2.out"
            });
        });
    </script>
</x-layouts.main>
