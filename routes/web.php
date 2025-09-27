<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Rutas de autenticación
Route::get('/login', function () {
    return view('components.layouts.login');
})->name('login.index');

Route::get('/register', function () {
    return view('components.layouts.register');
})->name('register.index');

// Rutas públicas de productos y blog (solo lectura)
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogPostController::class, 'show'])->name('blog.show');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // CRUD completo para Blog Posts
    Route::resource('admin/blog', BlogPostController::class)->except(['index', 'show']);
    
    // CRUD completo para Productos
    Route::resource('admin/product', ProductController::class)->except(['index', 'show']);
    
    // Rutas adicionales
    Route::get('/admin/blog', [BlogPostController::class, 'index'])->name('admin.blog.index');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product.index');
});

// Ruta de ejemplo
Route::get('/item', function () {
    $customBreadcrumbs = [
        ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
        ['name' => 'Product', 'url' => '#', 'active' => false],
        ['name' => 'Blog', 'url' => '#', 'active' => false],
        ['name' => 'Detalle del Producto', 'url' => route('item.example'), 'active' => true]
    ]; 

    return view('item-example', compact('customBreadcrumbs'));
})->name('item.example');
