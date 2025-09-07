<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\BreadcrumbHelper;

class BreadcrumbServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Registrar el helper globalmente
        if (!function_exists('breadcrumbs')) {
            function breadcrumbs($custom = null)
            {
                if ($custom) {
                    return BreadcrumbHelper::custom($custom);
                }
                return BreadcrumbHelper::generate();
            }
        }

        if (!function_exists('addBreadcrumb')) {
            function addBreadcrumb($name, $url = '#', $active = true)
            {
                return BreadcrumbHelper::add($name, $url, $active);
            }
        }
    }
}
