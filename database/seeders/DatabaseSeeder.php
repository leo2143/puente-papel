<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios desde los datos del CSV
        $users = [
            [
                'name' => 'admin',
                'email' => 'test@puentepapel.com',
                'last_name' => 'Test Last Name',
                'phone' => '1165893493',
                'role' => 'admin',
                'is_active' => true,
                'password' => '$2y$12$oE4wGgKgTB1nLzDiXy1jf.gQqgHqT95a/OQnmgj3MXaWcr0buQ/A.', // password
                'email_verified_at' => '2025-10-04 19:17:34',
                'remember_token' => 'Ioai25h9xZ',
            ],
            [
                'name' => 'leonardo',
                'email' => 'leitoorellana58@gmail.com',
                'last_name' => 'orellana',
                'phone' => '451312313213',
                'role' => 'user',
                'is_active' => true,
                'password' => '$2y$12$3XY3do.3PaoYbtRaHzVMPuWr4rxTARk9BdkcAx/.4lfPxnpApIk66', // password
                'email_verified_at' => null,
                'remember_token' => null,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Ejecutar los seeders
        $this->call([
            ProductSeeder::class,
            BlogPostSeeder::class,
            OrderSeeder::class,
        ]);
    }
}