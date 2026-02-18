<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear Admin solo si no existe
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Usuario 1
        User::firstOrCreate(
            ['email' => 'user1@test.com'],
            [
                'name' => 'Usuario 1',
                'password' => Hash::make('usuario1'),
                'role' => 'user',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user2@test.com'],
            [
                'name' => 'Usuario 2',
                'password' => Hash::make('usuario2'),
                'role' => 'user',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user3@test.com'],
            [
                'name' => 'Usuario 3',
                'password' => Hash::make('usuario3'),
                'role' => 'user',
            ]
        );
    }
}
