<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\AboutController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/sobre-nosotros', [AboutController::class, 'index'])->name('about');

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

// Rutas de administración (requieren autenticación y rol admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Usuarios
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Productos
    Route::resource('product', AdminProductController::class)->except(['index', 'show']);
    Route::get('product', [AdminProductController::class, 'index'])->name('product.index');
    
    // Blog
    Route::resource('blog', AdminBlogController::class)->except(['index', 'show']);
    Route::get('blog', [AdminBlogController::class, 'index'])->name('blog.index');
});