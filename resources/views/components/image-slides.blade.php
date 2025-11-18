{{-- resources/views/components/image-slides.blade.php --}}

<?php
$slides = [['url' => asset('storage/carrusel/carrusel-7.png')], ['url' => asset('storage/carrusel/carrusel-8.png')], ['url' => asset('storage/carrusel/carrusel-9.png')]];
?>

<div class="max-w-[2600px] h-[480px] w-full m-auto  relative group" id="image-slider">
    {{-- Imagen actual --}}
    <div id="slider-image" class="w-full h-full rounded-2xl bg-center bg-cover duration-500 transition-all" style="">
    </div>

    {{-- Flecha izquierda --}}
    <button id="prev-slide"
        class="hidden group-hover:block absolute top-[50%] -translate-x-0 translate-y-[-50%] left-5 text-2xl rounded-full p-2 bg-black/20 text-white cursor-pointer hover:bg-black/40 transition-colors"
        aria-label="Imagen anterior">
        <img src="{{ asset('storage/icons-svg/chevron-left.svg') }}" alt="Imagen anterior" title="Imagen anterior" class="w-8 h-8">
    </button>

    {{-- Flecha derecha --}}
    <button id="next-slide"
        class="hidden group-hover:block absolute top-[50%] -translate-x-0 translate-y-[-50%] right-5 text-2xl rounded-full p-2 bg-black/20 text-white cursor-pointer hover:bg-black/40 transition-colors"
        aria-label="Imagen siguiente">
        <img src="{{ asset('storage/icons-svg/chevron-right.svg') }}" alt="Imagen siguiente" title="Imagen siguiente" class="w-8 h-8">
    </button>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = @json($slides);
        let currentIndex = 0;
        const sliderImage = document.getElementById('slider-image');
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');
        const dots = document.querySelectorAll('.slide-dot');

        // Actualizar imagen
        function updateSlide(index) {
            currentIndex = index;
            sliderImage.style.backgroundImage = `url('${slides[currentIndex].url}')`;

            // Actualizar dots activos
            dots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.add('text-gray-800');
                    dot.classList.remove('text-gray-400');
                } else {
                    dot.classList.add('text-gray-400');
                    dot.classList.remove('text-gray-800');
                }
            });
        }

        // Slide anterior
        function prevSlide() {
            const newIndex = currentIndex === 0 ? slides.length - 1 : currentIndex - 1;
            updateSlide(newIndex);
        }

        // Slide siguiente
        function nextSlide() {
            const newIndex = currentIndex === slides.length - 1 ? 0 : currentIndex + 1;
            updateSlide(newIndex);
        }

        // Ir a slide específico
        function goToSlide(index) {
            updateSlide(index);
        }

        // Event listeners
        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToSlide(index));
        });


        updateSlide(0);
    });
</script>

<style>

</style>
