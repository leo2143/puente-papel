<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogPostController extends Controller
{
    /**
     * Renderiza la lista de posts disponibles
     */
    public function index()
    {
        $posts = BlogPost::with('user')
            ->where('status', 'published')
            ->latest()
            ->get();
        return view('blog.index', compact('posts'));
    }

    /**
     * Renderiza un post particular.
     */
    public function show(BlogPost $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
        
        $post->load('user');
        return view('blog.show', compact('post'));
    }
}
