<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\AuthController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Rutas de autenticación
Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    // Rutas públicas de autenticación
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    
    // Rutas protegidas de autenticación
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

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