{{-- resources/views/components/button.blade.php --}}

<?php
// Tamaños
$buttonSize = $buttonSize ?? 'medium';
switch ($buttonSize) {
    case 'small':
        $buttonSize = 'text-sm px-3 py-1';
        break;
    case 'medium':
        $buttonSize = 'text-base px-4 py-2';
        break;
    case 'large':
        $buttonSize = 'text-lg px-6 py-3';
        break;
    default:
        $buttonSize = 'text-base px-4 py-2';
        break;
}

// Variantes de color
$buttonVariant = $variant ?? 'primary';
switch ($buttonVariant) {
    case 'primary':
        $buttonVariant = 'bg-primary-color';
        break;
    case 'secondary':
        $buttonVariant = 'bg-secondary-color';
        break;
    case 'success':
        $buttonVariant = 'bg-green-500';
        break;
    case 'danger':
        $buttonVariant = 'bg-red-500';
        break;
    default:
        $buttonVariant = 'bg-primary-color';
        break;
}
?>

<button id="btn" onclick="{{ $onclick ?? '' }}" type="{{ $type ?? 'submit' }}"
    class="bg-{{ $variant ?? 'primary' }}-color text-quinary-color text-amber-50 px-4 py-2 rounded-md transition-all duration-300 relative overflow-hidden {{ $buttonSize }}"
    {{ $attributes }}>

    <span class="relative z-10">{{ $slot }}</span>
    <div
        class="absolute inset-0 bg-gradient-to-r from-transparent via-white to-transparent opacity-0 transform -skew-x-12 -translate-x-full shimmer">
    </div>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('btn');

        // Animación de entrada
        gsap.fromTo(button, {
            opacity: 0,
            y: 20,
            scale: 0.9
        }, {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.6,
            ease: "back.out(1.7)"
        });

        // Animación de pulso de colores (incentiva al click)
        const pulseAnimation = gsap.to(button, {
            boxShadow: "0 0 20px rgba(217, 0, 0, 0.6), 0 0 40px rgba(217, 0, 0, 0.4)",
            duration: 2,
            ease: "power2.inOut",
            yoyo: true,
            repeat: -1
        });

        // Animación de brillo (shimmer effect) - CONSTANTE POR DEFECTO
        const shimmer = button.querySelector('.shimmer');
        const shimmerAnimation = gsap.to(shimmer, {
            x: "200%",
            duration: 1.5,
            ease: "none",
            repeat: -1,
            delay: 0
        });

        // Hacer el shimmer visible por defecto
        gsap.set(shimmer, {
            opacity: 0.2
        });

        // Animación de hover (más intensa)
        button.addEventListener('mouseenter', function() {
            gsap.to(button, {
                scale: 1.05,
                y: -2,
                boxShadow: "0 0 30px rgba(217, 0, 0, 0.8), 0 0 60px rgba(217, 0, 0, 0.6)",
                duration: 0.3,
                ease: "power2.out"
            });

            // Brillo más intenso en hover
            gsap.to(shimmer, {
                opacity: 0.4,
                duration: 0.3
            });
        });

        button.addEventListener('mouseleave', function() {
            gsap.to(button, {
                scale: 1,
                y: 0,
                boxShadow: "0 0 20px rgba(217, 0, 0, 0.6), 0 0 40px rgba(217, 0, 0, 0.4)",
                duration: 0.3,
                ease: "power2.out"
            });

            // Brillo normal (pero sigue visible)
            gsap.to(shimmer, {
                opacity: 0.2,
                duration: 0.3
            });
        });
    });
</script>
