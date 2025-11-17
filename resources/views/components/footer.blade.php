{{-- resources/views/components/footer.blade.php --}}

<footer class="bg-gray-900 text-white relative overflow-hidden">
    {{-- Patrón de fondo decorativo --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-32 h-32 bg-pink-500 rounded-full -translate-x-16 -translate-y-16"></div>
        <div class="absolute top-1/4 right-0 w-24 h-24 bg-red-500 rounded-full translate-x-12"></div>
        <div class="absolute bottom-0 left-1/3 w-20 h-20 bg-purple-500 rounded-full translate-y-10"></div>
    </div>

    <div class="relative z-10">
        {{-- Contenido principal del footer --}}
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Columna 1: Información de la empresa --}}
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('storage/images/puente_papel_icon.png') }}" alt="Puente Papel"
                            class="w-10 h-8">
                        <span
                            class="text-xl font-bold bg-gradient-to-r from-pink-400 to-red-400 bg-clip-text text-transparent">
                            Puente Papel
                        </span>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Conectamos ideas a través del papel. Especialistas en materiales educativos y recursos
                        didácticos innovadores.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#"
                            class="w-8 h-8 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-8 h-8 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-8 h-8 bg-gray-800 hover:bg-pink-600 rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Columna 2: Enlaces rápidos --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-pink-400">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Inicio</a>
                        </li>
                        <li><a href="{{ route('product.index') }}"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Productos</a>
                        </li>
                        <li><a href="{{ route('about') }}"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Acerca
                                de</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Contacto</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Blog</a>
                        </li>
                    </ul>
                </div>

                {{-- Columna 3: Categorías --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-pink-400">Categorías</h3>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Material
                                Educativo</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Libros</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Recursos
                                Didácticos</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Pictogramas</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-pink-400 transition-colors duration-200 text-sm">Efemérides</a>
                        </li>
                    </ul>
                </div>

                {{-- Columna 4: Contacto --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-pink-400">Contacto</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center">
                                <img src="{{ asset('storage/icons-svg/phone.svg') }}" alt="" class="w-4 h-4 text-white" aria-hidden="true">
                            </div>
                            <span class="text-gray-300 text-sm">+54 11 2463 6219</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center">
                                <img src="{{ asset('storage/icons-svg/email.svg') }}" alt="" class="w-4 h-4 text-white" aria-hidden="true">
                            </div>
                            <span class="text-gray-300 text-sm">puentepapel@gmail.com</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center mt-1">
                                <img src="{{ asset('storage/icons-svg/location.svg') }}" alt="" class="w-4 h-4 text-white" aria-hidden="true">
                            </div>
                            <span class="text-gray-300 text-sm">Buenos Aires, Argentina</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Línea divisoria --}}
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-gray-400 text-sm">
                        © {{ date('Y') }} Puente Papel. Todos los derechos reservados.
                    </div>
                    <div class="flex space-x-6 text-sm">
                        <a href="#"
                            class="text-gray-400 hover:text-pink-400 transition-colors duration-200">Política de
                            Privacidad</a>
                        <a href="#"
                            class="text-gray-400 hover:text-pink-400 transition-colors duration-200">Términos de
                            Uso</a>
                        <a href="#"
                            class="text-gray-400 hover:text-pink-400 transition-colors duration-200">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación de entrada del footer
        gsap.fromTo('footer', {
            opacity: 0,
            y: 50
        }, {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: "power2.out"
        });

        // Animación escalonada de las columnas
        gsap.fromTo('footer .grid > div', {
            opacity: 0,
            y: 30
        }, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
            stagger: 0.2,
            delay: 0.3
        });

        // Animación de los elementos decorativos
        gsap.fromTo('footer .absolute', {
            scale: 0,
            rotation: 180
        }, {
            scale: 1,
            rotation: 0,
            duration: 1.5,
            ease: "back.out(1.7)",
            delay: 0.5
        });

        // Efecto hover en los enlaces
        const footerLinks = document.querySelectorAll('footer a');
        footerLinks.forEach(link => {
            link.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.05,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });

            link.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    duration: 0.2,
                    ease: "power2.out"
                });
            });
        });

        // Efecto hover en los iconos sociales
        const socialIcons = document.querySelectorAll('footer .w-8.h-8');
        socialIcons.forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.2,
                    rotation: 10,
                    duration: 0.3,
                    ease: "back.out(1.7)"
                });
            });

            icon.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    rotation: 0,
                    duration: 0.3,
                    ease: "back.out(1.7)"
                });
            });
        });

        // Animación de pulso en el título del logo
        const logoTitle = document.querySelector('footer h2.bg-gradient-to-r');
        if (logoTitle) {
            gsap.to(logoTitle, {
                scale: 1.05,
                duration: 2,
                ease: "power2.inOut",
                yoyo: true,
                repeat: -1
            });
        }
    });
</script>
