<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Listar productos para administración
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtro de búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Crear nuevo producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'status' => 'required|in:active,inactive'
        ]);

        // Manejar imagen usando ImageService
        $imageFileName = null;
        if ($request->hasFile('image')) {
            try {
                $imageFileName = ImageService::upload(
                    $request->file('image'), 
                    'products'
                );
            } catch (\Exception $e) {
                return back()->withErrors(['image' => $e->getMessage()])->withInput();
            }
        }

        Product::create([
            'title' => $validated['title'],
            'name' => $validated['name'] ?? $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image' => $imageFileName,
            'status' => $validated['status'] ?? 'active',
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Producto creado exitosamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Product $product)
    {
        // Debug: verificar que el producto se está recibiendo correctamente
        Log::info('Editando producto ID: ' . $product->id . ', Título: ' . $product->title);
        
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'status' => 'required|in:active,inactive'
        ]);

        // Manejar imagen usando ImageService
        $imageFileName = $product->image;
        
        // Si se sube una nueva imagen
        if ($request->hasFile('image')) {
            try {
                $imageFileName = ImageService::upload(
                    $request->file('image'), 
                    'products',
                    $product->image // Imagen anterior para eliminar
                );
            } catch (\Exception $e) {
                return back()->withErrors(['image' => $e->getMessage()])->withInput();
            }
        }
        
        // Si se marca para eliminar la imagen
        if ($request->has('image_delete') && $request->image_delete) {
            if ($product->image) {
                ImageService::delete($product->image, 'products');
            }
            $imageFileName = null;
        }

        $product->update([
            'title' => $validated['title'],
            'name' => $validated['name'] ?? $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image' => $imageFileName,
            'status' => $validated['status'] ?? 'active',
        ]);

        return redirect()->route('admin.product.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar producto
     */
    public function destroy(Product $product)
    {
        // Eliminar imagen asociada
        if ($product->image) {
            ImageService::delete($product->image, 'products');
        }

        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}