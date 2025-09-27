<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <x-header />
    <main class="max-w-7xl mx-auto h-screen flex flex-col align-items-center justify-center">

        <div class="flex flex-col gap-2 p-20 bg-secondary-color justify-center gap-20 rounded-md">
            <h1 class="bg-secondary-200-color text-3xl font-bold  text-center">Registrar</h1>

            <div class="flex flex-col gap-5 justify-center">
                <form action="{{ route('register.index') }}" method="post"
                    class="flex flex-col gap-4 justify-center items-center">
                    @csrf
                    <div class="flex gap-10 flex-wrap justify-center ">
                        <input type="text" name="name" placeholder="Nombre" required
                            class="w-100 p-2 rounded-md border border-primary-color">
                        <input type="text" name="last_name" placeholder="Apellido" required
                            class="w-100 p-2 rounded-md border border-primary-color">
                        <input type="email" name="email" placeholder="Email" required
                            class="w-100 p-2 rounded-md border border-primary-color">
                        <input type="text" name="phone" placeholder="Teléfono" required
                            class="w-100 p-2 rounded-md border border-primary-color">
                    </div>
                    <h2 class="text-2xl text-left font-bold">Contraseña</h2>

                    <div class="  gap-10 ">
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full p-2 rounded-md border border-primary-color">
                    </div>
                    <button type="submit"
                        class="w-full p-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">Registrar</button>
                </form>

                <div class="flex flex-col gap-2">
                    <a href="" class="text-blue-500 hover:text-blue-600">¿Olvidaste tu contraseña?</a>
                    <a href="{{ route('login.index') }}" class="text-blue-500 hover:text-blue-600">¿Ya tienes una
                        cuenta? Inicia sesión</a>
                </div>

            </div>

        </div>

    </main>
    <x-footer />
</body>

</html>
