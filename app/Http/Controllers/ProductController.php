<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Muestra el listado público de productos.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtro de categoría
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $product = $query->where('status', 'active')
            ->where('is_active', true)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('product.index', compact('product'));
    }

    /**
     * Muestra el detalle de un producto.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }
}