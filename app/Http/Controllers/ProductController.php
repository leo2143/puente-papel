<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('user')->latest()->get();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image_path' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image_path' => $validated['image_path'] ?? null,
            'stock' => $validated['stock'],
            'is_active' => $validated['is_active'] ?? true,
            'user_id' => $this->currentUser()->id
        ]);

        return $this->redirectWithSuccess('product.index', 'Producto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('user');
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image_path' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image_path' => $validated['image_path'] ?? $product->image_path,
            'stock' => $validated['stock'],
            'is_active' => $validated['is_active'] ?? $product->is_active
        ]);

        return $this->redirectWithSuccess('product.index', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->redirectWithSuccess('product.index', 'Producto eliminado exitosamente');
    }
}