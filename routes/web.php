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
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\OrderController;
use App\Http\Middleware\VerifyMercadoPagoPaymentSignature;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

// Rutas de autenticación
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        // Formularios de login/registro (solo para invitados)
        Route::middleware('guest')->group(function () {
            Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
            Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
        });

        // Procesar login/registro (sin middleware guest para evitar problemas de redirección)
        Route::post('/login', [AuthController::class, 'login'])->name('login.process');
        Route::post('/register', [AuthController::class, 'register'])->name('register.process');

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

// Rutas del carrito de compras (públicas, manejo por sesión)
Route::prefix('cart')
    ->name('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{productId}', [CartController::class, 'remove'])->name('remove');
        Route::post('/update', [CartController::class, 'update'])->name('update');
        Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    });

// Webhook de Mercado Pago (FUERA de auth - viene del servidor de MP)
Route::post('/mp/verify-payment', [OrderController::class, 'verifyPayment'])
    ->middleware(VerifyMercadoPagoPaymentSignature::class)
    ->withoutMiddleware(VerifyCsrfToken::class)
    ->name('orders.mp.verify-payment');

// Rutas de órdenes (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Checkout
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    // Órdenes
    Route::prefix('orders')
        ->name('orders.')
        ->group(function () {
            Route::post('/', [OrderController::class, 'store'])->name('store');
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        });

    // Callbacks de Mercado Pago (retorno del usuario)
    Route::get('/mp/success', [OrderController::class, 'mpSuccess'])->name('orders.mp.success');
    Route::get('/mp/failure', [OrderController::class, 'mpFailure'])->name('orders.mp.failure');
    Route::get('/mp/pending', [OrderController::class, 'mpPending'])->name('orders.mp.pending');
});

// Rutas de administración (requieren autenticación y rol admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Usuarios
    Route::resource('users', UserController::class);
    Route::get('users/{user}/details', [UserController::class, 'show'])->name('users.show');
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Productos
    Route::resource('product', AdminProductController::class)->except(['index', 'show']);
    Route::get('product', [AdminProductController::class, 'index'])->name('product.index');

    // Blog
    Route::resource('blog', AdminBlogController::class)
        ->except(['index', 'show'])
        ->parameters(['blog' => 'post']);
    Route::get('blog', [AdminBlogController::class, 'index'])->name('blog.index');
});
