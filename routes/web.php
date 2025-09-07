<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Cambiar de Inertia::render a view()
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/products', function () {
    return view('products');
})->name('products.index');

Route::get('/item', function () {
    // Ejemplo de breadcrumbs personalizados usando el componente
    $customBreadcrumbs = [
        ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
        ['name' => 'Productos', 'url' => '#', 'active' => false],
        ['name' => 'Detalle del Producto', 'url' => route('item.example'), 'active' => true]
    ];

    return view('item-example', compact('customBreadcrumbs'));
})->name('item.example');
