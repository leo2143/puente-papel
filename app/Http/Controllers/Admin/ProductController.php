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

        $products = $query->latest()->paginate(15)->withQueryString();

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

        try {
            // Manejar imagen usando ImageService
            $imageFileName = null;
            if ($request->hasFile('image')) {
                try {
                    $imageFileName = ImageService::upload(
                        $request->file('image'), 
                        'products'
                    );
                } catch (\Exception $e) {
                    return back()
                        ->withInput()
                        ->with('feedback.message', 'Error al subir la imagen: ' . $e->getMessage())
                        ->with('feedback.type', 'danger');
                }
            }

            // Usar only() para obtener solo los campos que necesitamos (whitelisting)
            $data = $request->only(['title', 'description', 'price', 'category', 'status']);
            
            // Campos adicionales
            $data['name'] = $validated['name'] ?? $validated['title'];
            $data['image'] = $imageFileName;
            $data['status'] = $validated['status'] ?? 'active';

            Product::create($data);
        } catch (\Throwable $th) {
            // Limpiar recursos si es necesario
            if (isset($imageFileName) && $imageFileName && ImageService::exists($imageFileName, 'products')) {
                ImageService::delete($imageFileName, 'products');
            }

            return back()
                ->withInput()
                ->with('feedback.message', 'Error al crear el producto')
                ->with('feedback.type', 'danger');
        }

        return to_route('admin.product.index')
            ->with('feedback.message', 'Producto creado exitosamente')
            ->with('feedback.type', 'success');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:active,inactive'
        ], [
            'title.required' => 'El título es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'price.numeric' => 'El precio debe ser un número.',
            'status.required' => 'El estado es obligatorio.',
        ]);

        try {
            // Manejar imagen usando ImageService
            $imageFileName = $product->image;
            $oldCover = null;
            
            // Si se sube una nueva imagen
            if ($request->hasFile('image')) {
                $oldCover = $product->image;
                try {
                    $imageFileName = ImageService::upload(
                        $request->file('image'), 
                        'products',
                        $product->image
                    );
                } catch (\Exception $e) {
                    return back()
                        ->withInput()
                        ->with('feedback.message', 'Error al subir la imagen: ' . $e->getMessage())
                        ->with('feedback.type', 'danger');
                }
            }
            
            // Si se marca para eliminar la imagen
            if ($request->has('image_delete') && $request->image_delete) {
                if ($product->image && ImageService::exists($product->image, 'products')) {
                    ImageService::delete($product->image, 'products');
                }
                $imageFileName = null;
            }

            // Usar only() para obtener solo los campos que necesitamos
            $data = $request->only(['title', 'description', 'price', 'category', 'status']);
            $data['name'] = $validated['name'] ?? $validated['title'];
            $data['image'] = $imageFileName;
            $data['status'] = $validated['status'] ?? 'active';

            $product->update($data);

            // Eliminar imagen antigua si se subió una nueva
            if ($oldCover !== null && $oldCover !== $imageFileName && ImageService::exists($oldCover, 'products')) {
                ImageService::delete($oldCover, 'products');
            }
        } catch (\Throwable $th) {
            return back()
                ->withInput()
                ->with('feedback.message', 'Error al actualizar el producto')
                ->with('feedback.type', 'danger');
        }

        return to_route('admin.product.index')
            ->with('feedback.message', 'Producto actualizado exitosamente')
            ->with('feedback.type', 'success');
    }

    /**
     * Eliminar producto
     */
    public function destroy(Product $product)
    {
        try {
            // Eliminar imagen asociada
            if ($product->image && ImageService::exists($product->image, 'products')) {
                ImageService::delete($product->image, 'products');
            }

            $product->delete();

            return to_route('admin.product.index')
                ->with('feedback.message', 'Producto <b>' . e($product->title) . '</b> eliminado exitosamente')
                ->with('feedback.type', 'success');
        } catch (\Throwable $th) {
            return to_route('admin.product.index')
                ->with('feedback.message', 'Error al eliminar el producto')
                ->with('feedback.type', 'danger');
        }
    }
}
