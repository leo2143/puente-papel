<?php

namespace App\Helpers;

class BreadcrumbHelper
{
    /**
     * Genera breadcrumbs automáticamente basado en la ruta actual
     */
    public static function generate()
    {
        $currentRoute = request()->route();
        $routeName = $currentRoute ? $currentRoute->getName() : null;

        // Mapeo de rutas a breadcrumbs
        $routeMap = [
            'home' => [
                ['name' => 'Inicio', 'url' => route('home'), 'active' => true]
            ],
            'about' => [
                ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
                ['name' => 'Acerca de', 'url' => route('about'), 'active' => true]
            ],
            'products.index' => [
                ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
                ['name' => 'Productos', 'url' => route('products.index'), 'active' => true]
            ],
            'item.example' => [
                ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
                ['name' => 'Productos', 'url' => '#', 'active' => false],
                ['name' => 'Detalle', 'url' => route('item.example'), 'active' => true]
            ]
        ];

        // Si la ruta existe en el mapeo, devolver esos breadcrumbs
        if ($routeName && isset($routeMap[$routeName])) {
            return $routeMap[$routeName];
        }

        // Si no existe, generar breadcrumbs básicos
        return [
            ['name' => 'Inicio', 'url' => route('home'), 'active' => false],
            ['name' => 'Página Actual', 'url' => '#', 'active' => true]
        ];
    }

    /**
     * Genera breadcrumbs personalizados
     */
    public static function custom($breadcrumbs)
    {
        return $breadcrumbs;
    }

    /**
     * Agrega un breadcrumb al final de la lista
     */
    public static function add($name, $url = '#', $active = true)
    {
        $current = self::generate();

        // Marcar el último como no activo
        if (!empty($current)) {
            $current[count($current) - 1]['active'] = false;
        }

        // Agregar el nuevo breadcrumb
        $current[] = [
            'name' => $name,
            'url' => $url,
            'active' => $active
        ];

        return $current;
    }
}
