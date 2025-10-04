<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Dashboard de administración
     */
    public function dashboard()
    {
        $stats = [
            'products' => Product::count(),
            'posts' => BlogPost::count(),
            'users' => User::count(),
            'published_posts' => BlogPost::where('status', 'published')->count(),
        ];

        // Actividad reciente (últimos 5 posts)
        $recent_activity = BlogPost::with('user')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($post) {
                return [
                    'description' => "Nuevo post: '{$post->title}' por {$post->user->name}",
                    'time' => $post->created_at->diffForHumans()
                ];
            });

        return view('admin.dashboard', compact('stats', 'recent_activity'));
    }
}
