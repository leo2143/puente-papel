<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? '' }} :: DV Películas</title>
    <link rel="stylesheet" href="<?= url('css/styles.css'); ?>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            height: 100%;
        }
    </style>
</head>

<body class=" h-full relative">
    {{-- Canvas para ThpaceGL - Fondo de toda la página --}}
    <canvas id="make-me-cool" class="fixed inset-0 w-full h-full z-0"></canvas>
    
    <div id="app" class="relative z-10 h-full">
        {{-- Header - Fila 1 (56px) --}}
            <x-header />

        {{-- Main Content - Fila 2 (1fr - toma el espacio restante) --}}
        <main class="overflow-y-auto">
            {{-- Contenido principal --}}
            <div>
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

                <?= e(expresión); ?>

                Les debe llamar la atención es esa función e().
                La función e() (que viene de "escape") es equivalente a la
                función nativa de php htmlspecialchars().
                Esto es muy importante, porque nos protege de un tipo de
                ataque llamado Cross-Site Scripting (XSS).

                Si realmente quieren imprimir la expresión sin escaparla con
                e(), Blade lo permite con una sintaxis diferente:

                {!! expresión !!}

                Esto sí es idéntico a:

                <?= expresión; ?>
                --}}
                {{ $slot }}
            </div>
        </main>

        {{-- Footer - Fila 3 (100px) --}}
            <x-footer />
    </div>

    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>