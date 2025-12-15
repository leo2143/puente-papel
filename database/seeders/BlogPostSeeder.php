<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        // Obtener el primer usuario
        $user = User::first();

        if (!$user) {
            throw new \Exception('No se encontró ningún usuario. Asegúrate de ejecutar el DatabaseSeeder primero.');
        }

        // Crear posts desde los datos del CSV
        $blogPosts = [
            [
                'title' => 'Bienvenidos a Puente Papel',
                'slug' => 'bienvenidos-a-puente-papel',
                'content' => 'Este es nuestro primer post en el blog de Puente Papel. Aquí compartiremos noticias, novedades y contenido relacionado con nuestros productos educativos.',
                'featured_image' => '1759902917.png',
                'status' => 'published',
                'user_id' => $user->id
            ],
            [
                'title' => 'Nuevos Productos de Comunicación',
                'slug' => 'nuevos-productos-de-comunicacion',
                'content' => 'Hemos lanzado nuevos productos para mejorar la comunicación visual. Pictogramas, rutinas y herramientas que facilitan el aprendizaje.',
                'featured_image' => '1759902877.jpg',
                'status' => 'published',
                'user_id' => $user->id
            ],
            [
                'title' => 'Guía de Uso de Pictogramas',
                'slug' => 'guia-de-uso-de-pictogramas',
                'content' => 'Te explicamos cómo usar nuestros pictogramas de manera efectiva en el aula o en casa. Consejos y técnicas para maximizar el aprendizaje.',
                'featured_image' => '1759902897.jpg',
                'status' => 'published',
                'user_id' => $user->id
            ],
        ];

        foreach ($blogPosts as $postData) {
            BlogPost::create($postData);
        }
    }
}