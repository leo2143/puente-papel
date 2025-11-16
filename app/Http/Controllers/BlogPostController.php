<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Display the specified resource.
     */
    public function show(BlogPost $post)
    {
        // Solo mostrar posts publicados
        if ($post->status !== 'published') {
            abort(404);
        }
        
        $post->load('user');
        return view('blog.show', compact('post'));
    }
}
