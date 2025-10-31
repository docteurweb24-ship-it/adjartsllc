<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrateur Principal',
            'email' => 'admin@adj-arts.com',
            'password' => Hash::make('admin123'), // À changer après la première connexion
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Éditeur Content',
            'email' => 'editor@adj-arts.com',
            'password' => Hash::make('editor123'),
            'role' => 'editor',
            'is_active' => true,
        ]);
    }
}