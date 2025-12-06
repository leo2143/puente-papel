<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'test@puentepapel.com',
                'last_name' => 'Test Last Name',
                'phone' => '1165893493',
                'role' => 'admin',
                'is_active' => true,
                'password' => Hash::make('puentepapel'),
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
                'password' => Hash::make('leonardoorellana2'),
                'email_verified_at' => null,
                'remember_token' => null,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
