<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} :: Panel de administración de DV Películas</title>
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= url('css/styles.css') ?>">
</head>

<body>
    <div class="d-flex">
        <nav class="col-3 bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= route('home') ?>">DV Películas</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Mostrar / ocultar navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="" id="navbarNav">
                    <ul class="">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('home') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('about') ?>">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= route('product.index') ?>">Productos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="col-9">
            {{-- (esto es un comentario de Blade)
            Dentro de un componente, vamos a tener por defecto acceso a una
            variable llamada "$slot".
            Como sucede en otros frameworks de componentes (como Vue),
            $slot va a tener el contenido que se le incluya dentro del
            componente cuando se lo invoque.
            Por ejemplo, si llaman a este componente en otro de esta forma:

                <x-layouts.main>
                    <h1>¡Hola mundo!</h1>
                </x-layouts.main>

            $slot contendría el "<h1>¡Hola mundo!</h1>".

            ¿Qué pasa con la doble llave?
            Las dobles llaves son la forma en Blade para imprimir un valor
            en pantalla.

            Es decir, escribir:

                {{ expresión }}

            Es exactamente lo mismo que escribir:

            <?= e(expresión) ?>

            Les debe llamar la atención es esa función e().
            La función e() (que viene de "escape") es equivalente a la
            función nativa de php htmlspecialchars().
            Esto es muy importante, porque nos protege de un tipo de
            ataque llamado Cross-Site Scripting (XSS).

            Si realmente quieren imprimir la expresión sin escaparla con
            e(), Blade lo permite con una sintaxis diferente:

            {!! expresión !!}

            Esto sí es idéntico a:

            <?= expresión ?>
            --}}
            {{ $slot }}
        </main>
    </div>
    <footer class="footer">
        <p>Da Vinci &copy; 2025</p>
    </footer>
</body>

</html>
