<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Compartir breadcrumbs automáticos con todas las vistas
        View::composer('*', function ($view) {
            $breadcrumbs = $this->generateBreadcrumbs();
            $view->with('breadcrumbs', $breadcrumbs);
        });
    }

    /**
     * Generar breadcrumbs automáticos basados en la ruta actual
     */
    private function generateBreadcrumbs()
    {
        $routeName = request()->route()?->getName();
        $breadcrumbs = [];

        // Siempre incluir "Inicio"
        $breadcrumbs[] = [
            'name' => 'Inicio',
            'url' => route('home'),
            'active' => $routeName === 'home'
        ];

        // Generar breadcrumbs según la ruta
        switch ($routeName) {
            case 'about':
                $breadcrumbs[] = [
                    'name' => 'Acerca de',
                    'url' => route('about'),
                    'active' => true
                ];
                break;

            case 'product.index':
                $breadcrumbs[] = [
                    'name' => 'Productos',
                    'url' => route('product.index'),
                    'active' => true
                ];
                break;

            case 'product.show':
                $breadcrumbs[] = [
                    'name' => 'Productos',
                    'url' => route('product.index'),
                    'active' => false
                ];
                $breadcrumbs[] = [
                    'name' => 'Detalle del Producto',
                    'url' => '#',
                    'active' => true
                ];
                break;

            case 'blog.index':
                $breadcrumbs[] = [
                    'name' => 'Blog',
                    'url' => route('blog.index'),
                    'active' => true
                ];
                break;

            case 'blog.show':
                $breadcrumbs[] = [
                    'name' => 'Blog',
                    'url' => route('blog.index'),
                    'active' => false
                ];
                $breadcrumbs[] = [
                    'name' => 'Detalle del Post',
                    'url' => '#',
                    'active' => true
                ];
                break;

            case 'login.index':
                $breadcrumbs[] = [
                    'name' => 'Iniciar Sesión',
                    'url' => route('login.index'),
                    'active' => true
                ];
                break;

            case 'register.index':
                $breadcrumbs[] = [
                    'name' => 'Registrarse',
                    'url' => route('register.index'),
                    'active' => true
                ];
                break;

            default:
                // Para rutas no definidas, solo mostrar "Inicio"
                break;
        }

        return $breadcrumbs;
    }
}