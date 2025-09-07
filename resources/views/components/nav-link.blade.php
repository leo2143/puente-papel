{{--
request() retorna el objeto Request de la petición, que contiene toda la info relacionada a la misma.
Entre sus (muchos) métodos, figura routeIs() que retorna un booleano indicando si la ruta que está cargada matchea con el parámetro provisto.
--}}
<a
    class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}"
    {!! request()->routeIs($route) ? 'aria-current="page"' : '' !!}
    href="<?= route($route);?>"
>{{ $slot }}</a>
