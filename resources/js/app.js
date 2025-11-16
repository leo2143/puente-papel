import '@dile/editor/editor.js';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ThpaceGL } from 'thpace';

gsap.registerPlugin(ScrollTrigger);

// Hacer GSAP disponible globalmente
window.gsap = gsap;

// Inicializar ThpaceGL cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {
  const canvas = document.querySelector('#make-me-cool');

  if (canvas) {
    const settings = {
      colors: ['#fca5a5', '#fca5a5', '#f9a8d4', '#fca5a5', '#f9a8d4', '#fca5a5', '#f87171'],

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
        interval: [8000, 15000],
      },
    };

    // Crear la instancia de ThpaceGL
    const thpaceInstance = ThpaceGL.create(canvas, settings);

    window.thpaceInstance = thpaceInstance;
  }
});
