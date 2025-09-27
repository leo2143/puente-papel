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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'test@puentepapel.com',
            'last_name' => 'Test Last Name',
            'phone' => '1165893493',    
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Ejecutar los seeders
        $this->call([
            ProductSeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}