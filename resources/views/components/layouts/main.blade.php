<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Inicio' }} - Puente Papel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full relative">
    <h1>Puente Papel </h1>
    <canvas id="make-me-cool" class="fixed inset-0 w-full h-full z-0"></canvas>

    <div id="app" class="relative z-10 h-full w-full">
        <x-header class="relative z-50 w-full" />

        <main class="overflow-y-auto relative z-10">
            <div class=" mx-auto">
                {{ $slot }}
            </div>
        </main>

        <x-footer class="w-full" />
    </div>
</body>

</html>
