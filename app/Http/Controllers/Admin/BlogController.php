<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Listar posts para administración
     */
    public function index(Request $request)
    {
        $query = BlogPost::with('user');

        // Filtro de búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filtro por estado
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->latest()->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Crear nuevo post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
        ]);

        // Manejar imagen destacada usando ImageService
        $featuredImageFileName = null;
        if ($request->hasFile('featured_image')) {
            try {
                $featuredImageFileName = ImageService::upload(
                    $request->file('featured_image'), 
                    'blog'
                );
            } catch (\Exception $e) {
                return back()->withErrors(['featured_image' => $e->getMessage()])->withInput();
            }
        }

        BlogPost::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'], // JSON del Editor.js
            'status' => $validated['status'],
            'featured_image' => $featuredImageFileName,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post creado exitosamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        // Buscar el post manualmente para evitar problemas de route model binding
        $post = BlogPost::find($id);
        
        if (!$post) {
            abort(404, 'Post no encontrado');
        }
        
        return view('admin.blog.edit', compact('post'));
    }

    /**
     * Actualizar post
     */
    public function update(Request $request, $id)
    {
        // Buscar el post manualmente
        $post = BlogPost::find($id);
        
        if (!$post) {
            abort(404, 'Post no encontrado');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
        ]);

        // Manejar imagen destacada usando ImageService
        $featuredImageFileName = $post->featured_image;
        
        // Si se sube una nueva imagen
        if ($request->hasFile('featured_image')) {
            try {
                $featuredImageFileName = ImageService::upload(
                    $request->file('featured_image'), 
                    'blog',
                    $post->featured_image // Imagen anterior para eliminar
                );
            } catch (\Exception $e) {
                return back()->withErrors(['featured_image' => $e->getMessage()])->withInput();
            }
        }
        
        // Si se marca para eliminar la imagen
        if ($request->has('featured_image_delete') && $request->featured_image_delete) {
            if ($post->featured_image) {
                ImageService::delete($post->featured_image, 'blog');
            }
            $featuredImageFileName = null;
        }

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'featured_image' => $featuredImageFileName,
        ]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post actualizado exitosamente');
    }

    /**
     * Eliminar post
     */
    public function destroy($id)
    {
        // Buscar el post manualmente
        $post = BlogPost::find($id);
        
        if (!$post) {
            abort(404, 'Post no encontrado');
        }
        
        // Eliminar imagen destacada asociada
        if ($post->featured_image) {
            ImageService::delete($post->featured_image, 'blog');
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post eliminado exitosamente');
    }
}