<x-layouts.main>
    <x-slot:title>Iniciar Sesión</x-slot:title>
    <?php
    $backgroundImage = asset('storage/images/utils/hero.jpg'); ?>

    <div class=" min-h-screen bg-gray-50/20 flex justify-center items-center">

        <div class="flex flex-row w-full max-w-7xl mx-auto">
            {{-- Imagen - solo visible en desktop, ocupa 50% --}}
            <div class="hidden md:flex md:w-1/2 items-center justify-center">
                <img class="w-full h-full object-cover" src="{{ $backgroundImage }}" alt="Puente Papel" />
            </div>

            {{-- Formulario - ocupa 100% en móvil, 50% en desktop --}}
            <div
                class="w-full md:w-1/2 bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 flex items-center justify-center">
                <div class="w-full max-w-md">
                    <div class="p-5 text-center ">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Iniciar Sesión</h2>
                        <p class="text-gray-600">Accede a tu cuenta de Puente Papel</p>
                    </div>
                    {{-- Mostrar mensajes de éxito --}}
                    @if (session('feedback.message'))
                        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                            {!! session('feedback.message') !!}
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('auth.login.process') }}" method="POST">
                        @csrf

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
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Contraseña
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="appearance-none block w-full px-3 py-2 border @error('password') border-red-300 @else border-gray-300 @enderror rounded-md placeholder-gray-400 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                    Recordarme
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-red-600 hover:text-red-500">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">¿No tienes cuenta?</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('auth.register.show') }}"
                                class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                Crear cuenta nueva
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
