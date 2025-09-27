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
        // Obtener productos destacados (puedes agregar filtros aquí)
        $featuredProducts = Product::where('is_active', true)
            ->latest()
            ->take(8) // Limitar a 8 productos
            ->get();

        // Obtener productos por categoría (ejemplo)
        $communicationProducts = Product::where('is_active', true)
            ->where('category', 'comunicacion') // Ajusta según tu lógica de categorías
            ->latest()
            ->take(4)
            ->get();

        $readingProducts = Product::where('is_active', true)
            ->where('category', 'lectura') // Ajusta según tu lógica de categorías
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact('featuredProducts', 'communicationProducts', 'readingProducts'));
    }
}
