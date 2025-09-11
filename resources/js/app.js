import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ThpaceGL } from 'thpace';

gsap.registerPlugin(ScrollTrigger);

// Hacer GSAP disponible globalmente
window.gsap = gsap;

// Inicializar ThpaceGL cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.querySelector('#make-me-cool');
    
    if (canvas) {                
        //                       purple  pink  red
    // #a855f7 #ec4899 #ef4444 ; #d8b4fe #f9a8d4 #fca5a5
        const settings = {
            // colors: ['#ef4444', '#ec4899', '#fac8c7', '#fac8c7', '#fac8c7', '#ec4899', '#ef4444'],
            // colors: ['#d8b4fe', '#f9a8d4','#fca5a5','#fca5a5','#fca5a5','#f9a8d4','#d8b4fe'], -> ok
            colors: ['#fca5a5', '#fca5a5','#f9a8d4','#fca5a5','#f9a8d4','#fca5a5','#f87171'],

            triangleSize: 100,
            // Configuraciones optimizadas para fondo
            maxFps: 60,
            automaticResize: true,
            // Partículas sutiles para el fondo
            particleSettings: {
                count: [1, 1],
                color: '#ffffff',
                radius: [1.5, 1.5], // Aumenté el radio para que se vean mejor
                opacity: [0.5, 0.5], // Aumenté la opacidad para que se vean más
                interval: [8000, 15000]
            }
        };

        // Crear la instancia de ThpaceGL
        const thpaceInstance = ThpaceGL.create(canvas, settings);
        
        // Hacer la instancia disponible globalmente si es necesario
        window.thpaceInstance = thpaceInstance;
    }
});