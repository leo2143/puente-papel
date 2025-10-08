<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mostrar la página de inicio con productos destacados
     */
    public function index()
    {
        // Obtener productos destacados (todos los productos activos)
        $featuredProducts = Product::where('is_active', true)
            ->latest()
            ->take(8) // Limitar a 8 productos
            ->get();

        // Obtener productos por categoría - Comunicación
        $communicationProducts = Product::where('is_active', true)
            ->where('category', 'comunicacion')
            ->latest()
            ->take(4)
            ->get();

        // Obtener productos por categoría - Lectura
        $readingProducts = Product::where('is_active', true)
            ->where('category', 'lectura')
            ->latest()
            ->take(4)
            ->get();

        // Obtener productos por categoría - Matemáticas
        $mathProducts = Product::where('is_active', true)
            ->where('category', 'matematicas')
            ->latest()
            ->take(4)
            ->get();

        // Obtener productos por categoría - Ciencias
        $scienceProducts = Product::where('is_active', true)
            ->where('category', 'ciencias')
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact(
            'featuredProducts', 
            'communicationProducts', 
            'readingProducts',
            'mathProducts',
            'scienceProducts'
        ));
    }
}
