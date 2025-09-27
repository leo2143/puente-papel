<x-layouts.main>
    <x-slot:title>Blog DV Películas</x-slot:title>

<section class="max-w-7xl mx-auto flex  gap-10">

 <div class="p-10 rounded-2xl shadow-lg bg-amber-50">
    <a href="{{ route('blog.index') }}">
        <h2 class="text-2xl font-bold block">Subtitulo del blog</h2>
        <img src="{{ asset('productos/lectura/ludme-mis-recetas/ludme-mis-recetas-en-imágenes.jpg') }}" alt="Subtitulo del blog" class="w-full h-48 md:h-56 object-cover">
        <p class="text-gray-500 block">Descripción del blog</p>
    </a>        
    </div>
     <div class="p-10 rounded-2xl shadow-lg bg-amber-50">
    <a href="{{ route('blog.index') }}">
        <h2 class="text-2xl font-bold block">Subtitulo del blog</h2>
        <img src="{{ asset('assets/images/blog/blog-1.jpg') }}" alt="Subtitulo del blog" class="w-full h-48 md:h-56 object-cover">
        <p class="text-gray-500 block">Descripción del blog</p>
    </a>
    </div>
</section>
</x-layouts.main>