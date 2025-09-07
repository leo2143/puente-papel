<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Helpers\BreadcrumbHelper;

class Breadcrumbs extends Component
{
    /**
     * Array de breadcrumbs finales
     */
    public array $breadcrumbs;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?array $customBreadcrumbs = null,
        ?array $breadcrumbs = null
    ) {
        // Determinar qué breadcrumbs usar
        $this->breadcrumbs = $breadcrumbs ?? $this->customBreadcrumbs ?? BreadcrumbHelper::generate();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumbs');
    }
}
