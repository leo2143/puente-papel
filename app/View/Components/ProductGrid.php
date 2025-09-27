<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class ProductGrid extends Component
{
    /**
     * Array o Collection de productos
     */
    public $product;

    /**
     * Título de la sección
     */
    public string $title;

    /**
     * Subtítulo opcional
     */
    public ?string $subtitle;

    /**
     * URL para "Ver más"
     */
    public ?string $seeMoreUrl;

    /**
     * Texto del botón "Ver más"
     */
    public string $seeMoreText;

    /**
     * Número de columnas en desktop
     */
    public int $columns;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $product = [],
        string $title = 'Productos',
        ?string $subtitle = null,
        ?string $seeMoreUrl = null,
        string $seeMoreText = 'Ver más',
        int $columns = 4
    ) {
        $this->product = $product;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->seeMoreUrl = $seeMoreUrl;
        $this->seeMoreText = $seeMoreText;
        $this->columns = $columns;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-grid');
    }

    /**
     * Obtener las clases CSS para el grid según el número de columnas
     */
    public function getGridClasses(): string
    {
        $gridMap = [
            2 => 'grid-cols-1 md:grid-cols-2',
            3 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3',
            4 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-4',
            5 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5',
            6 => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6'
        ];

        return $gridMap[$this->columns] ?? $gridMap[4];
    }
}
