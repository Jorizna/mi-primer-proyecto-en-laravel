<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        foreach ([
            ['email' => 'user1@test.com', 'name' => 'Usuario 1', 'password' => 'usuario1'],
            ['email' => 'user2@test.com', 'name' => 'Usuario 2', 'password' => 'usuario2'],
            ['email' => 'user3@test.com', 'name' => 'Usuario 3', 'password' => 'usuario3'],
        ] as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => 'user',
                ]
            );
        }
    }
}
