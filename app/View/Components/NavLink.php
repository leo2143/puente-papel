<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/*
Las clases de los componentes nos permite personalizar cómo se debe
renderizar un componente.
Entre otras cosas, nos permite recibir y pasar "propiedades" (lo que
serían los atributos de HTML al usar el componente).
Deben heredar de la clase Illuminate\View\Component y, típicamente,
van a tener 2 métodos:
- __construct()
- render()

render es el que debe retornar cómo se renderiza el componente.
Casi siempre va a ser una vista.

Por su parte, el constructor es el que puede recibir las propiedades
que se le agreguen al componente cuando se lo usa.

Es decir, que si llamamos al componente:

    <x-nav-link route="home">...</x-nav-link>

Nuestro constructor va a recibir el valor "home" como dato para un
parámetro "$route".

Es importante aclarar que cualquier propiedad de la clase que sea
"pública" va a automáticamente estar disponible en la vista.
*/
class NavLink extends Component
{
    // public string $route;

    // /**
    //  * Create a new component instance.
    //  */
    // public function __construct(string $route)
    // {
    //     $this->route = $route;
    // }

    /*
    # Constructor Property Promotion
    Cuando trabajamos con clase es muy común tener algunas propiedades
    cuyos valores deben cargarse como parámetros del constructor.
    Por ejemplo:

        class Foo
        {
            public $bar;

            public function __construct($bar)
            {
                $this->bar = $bar;
            }
        }

    Tan común es, que en php 8 se agregó el concepto de "Constructor
    Property Promotion" que permite resolver esto en una sola
    instrucción:

        class Foo
        {
            public function __construct(public $bar)
            {}
        }

    Básicamente, agregamos el modificador de visibilidad (public,
    protected o private) directamente al parámetro del constructor.
    Con esto, php automágicamente lo transforma en una propiedad de
    la clase, y le asigna el valor.
    */
    public function __construct(
        public string $route,
        // private string $route,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
        // return view('components.nav-link', [
        //     'route' => $this->route,
        // ]);
    }
}
