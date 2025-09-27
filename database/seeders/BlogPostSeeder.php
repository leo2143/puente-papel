<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        // Obtener el primer usuario o crear uno si no existe
        $user = User::first();

        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@puentepapel.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Crear posts de ejemplo
        BlogPost::create([
            'title' => 'Bienvenidos a Puente Papel',
            'slug' => 'bienvenidos-a-puente-papel',
            'content' => 'Este es nuestro primer post en el blog de Puente Papel. Aquí compartiremos noticias, novedades y contenido relacionado con nuestros productos educativos.',
            'featured_image' => 'blog/bienvenidos.jpg',
            'status' => 'published',
            'user_id' => $user->id
        ]);

        BlogPost::create([
            'title' => 'Nuevos Productos de Comunicación',
            'slug' => 'nuevos-productos-comunicacion',
            'content' => 'Hemos lanzado nuevos productos para mejorar la comunicación visual. Pictogramas, rutinas y herramientas que facilitan el aprendizaje.',
            'featured_image' => 'blog/nuevos-productos.jpg',
            'status' => 'published',
            'user_id' => $user->id
        ]);

        BlogPost::create([
            'title' => 'Guía de Uso de Pictogramas',
            'slug' => 'guia-uso-pictogramas',
            'content' => 'Te explicamos cómo usar nuestros pictogramas de manera efectiva en el aula o en casa. Consejos y técnicas para maximizar el aprendizaje.',
            'featured_image' => 'blog/guia-pictogramas.jpg',
            'status' => 'draft',
            'user_id' => $user->id
        ]);
    }
}
