<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear productos de prueba
        $products = [
            [
                'title' => 'Nuestra historia en pictos',
                'name' => 'Nuestra historia en pictos',
                'description' => 'Libro educativo con pictogramas para mejorar la comunicación y el lenguaje en niños. Incluye actividades interactivas y materiales didácticos.',
                'price' => 30000,
                'author' => 'Silvana',
                'language' => 'Español',
                'publisher' => 'Puente Papel',
                'category' => 'comunicacion',
                'image' => 'https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Historia+en+Pictos',
                'images' => json_encode([
                    'https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Imagen+1',
                    'https://via.placeholder.com/400x500/4ECDC4/FFFFFF?text=Imagen+2',
                    'https://via.placeholder.com/400x500/45B7D1/FFFFFF?text=Imagen+3',
                ]),
                'stock' => 10,
                'is_active' => true,
            ],
            [
                'title' => 'Kit de Lectura Avanzada',
                'name' => 'Kit de Lectura Avanzada',
                'description' => 'Conjunto completo de herramientas para desarrollar habilidades de lectura y comprensión lectora en niños de todas las edades.',
                'price' => 25000,
                'author' => 'María González',
                'language' => 'Español',
                'publisher' => 'Puente Papel',
                'category' => 'lectura',
                'image' => 'https://via.placeholder.com/400x500/4ECDC4/FFFFFF?text=Kit+Lectura',
                'images' => json_encode([
                    'https://via.placeholder.com/400x500/4ECDC4/FFFFFF?text=Imagen+1',
                    'https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Imagen+2',
                    'https://via.placeholder.com/400x500/96CEB4/FFFFFF?text=Imagen+3',
                ]),
                'stock' => 15,
                'is_active' => true,
            ],
            [
                'title' => 'Material Didáctico Interactivo',
                'name' => 'Material Didáctico Interactivo',
                'description' => 'Recursos educativos diseñados para estimular el aprendizaje y la creatividad en el aula. Perfecto para profesores y terapeutas.',
                'price' => 35000,
                'author' => 'Carlos Ruiz',
                'language' => 'Español',
                'publisher' => 'Puente Papel',
                'category' => 'comunicacion',
                'image' => 'https://via.placeholder.com/400x500/45B7D1/FFFFFF?text=Material+Didactico',
                'images' => json_encode([
                    'https://via.placeholder.com/400x500/45B7D1/FFFFFF?text=Imagen+1',
                    'https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Imagen+2',
                    'https://via.placeholder.com/400x500/4ECDC4/FFFFFF?text=Imagen+3',
                ]),
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'title' => 'Juego de Comunicación',
                'name' => 'Juego de Comunicación',
                'description' => 'Tablero educativo para mejorar la comunicación y el lenguaje en niños. Incluye actividades interactivas y materiales didácticos.',
                'price' => 28000,
                'author' => 'Ana Martínez',
                'language' => 'Español',
                'publisher' => 'Puente Papel',
                'category' => 'comunicacion',
                'image' => 'https://via.placeholder.com/400x500/96CEB4/FFFFFF?text=Juego+Comunicacion',
                'images' => json_encode([
                    'https://via.placeholder.com/400x500/96CEB4/FFFFFF?text=Imagen+1',
                    'https://via.placeholder.com/400x500/45B7D1/FFFFFF?text=Imagen+2',
                    'https://via.placeholder.com/400x500/FF6B35/FFFFFF?text=Imagen+3',
                ]),
                'stock' => 12,
                'is_active' => true,
            ],
            [
                'title' => 'Cuentos con Pictogramas',
                'name' => 'Cuentos con Pictogramas',
                'description' => 'Colección de cuentos adaptados con pictogramas para facilitar la lectura y comprensión en niños con necesidades especiales.',
                'price' => 22000,
                'author' => 'Laura Sánchez',
                'language' => 'Español',
                'publisher' => 'Puente Papel',
                'category' => 'lectura',
                'image' => 'https://via.placeholder.com/400x500/FF9F43/FFFFFF?text=Cuentos+Pictogramas',
                'images' => json_encode([
                    'https://via.placeholder.com/400x500/FF9F43/FFFFFF?text=Imagen+1',
                    'https://via.placeholder.com/400x500/96CEB4/FFFFFF?text=Imagen+2',
                    'https://via.placeholder.com/400x500/4ECDC4/FFFFFF?text=Imagen+3',
                ]),
                'stock' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Guía de Terapia del Lenguaje',
                'name' => 'Guía de Terapia del Lenguaje',
                'description' => 'Manual completo para profesionales de la terapia del lenguaje con ejercicios prácticos y técnicas avanzadas.',
                'price' => 45000,
                'author' => 'Dr. Roberto López',
                'language' => 'Español',
                'publisher' => 'Puente Papel',
                'category' => 'comunicacion',
                'image' => 'https://via.placeholder.com/400x500/6C5CE7/FFFFFF?text=Guia+Terapia',
                'images' => json_encode([
                    'https://via.placeholder.com/400x500/6C5CE7/FFFFFF?text=Imagen+1',
                    'https://via.placeholder.com/400x500/FF9F43/FFFFFF?text=Imagen+2',
                    'https://via.placeholder.com/400x500/45B7D1/FFFFFF?text=Imagen+3',
                ]),
                'stock' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }
    }
}