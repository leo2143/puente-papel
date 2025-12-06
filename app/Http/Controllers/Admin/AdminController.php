<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;

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
            'total_sales' => Order::where('status', 'paid')->sum('total_amount'),
            'top_product' => Product::select('products.*', FacadesDB::raw('SUM(order_items.quantity) as total_sold'))
                ->join('order_items', 'products.id', '=', 'order_items.product_id')
                ->groupBy('products.id')
                ->orderByDesc('total_sold')
                ->first(),
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
