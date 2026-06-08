<?php

namespace Database\Seeders;

use App\Models\Perfil;
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
        Perfil::query()->upsert([
            ['id' => 1, 'nombre' => 'Admin'],
            ['id' => 2, 'nombre' => 'Empleado'],
        ], ['id'], ['nombre']);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'idperfil' => 1,
        ]);
    }
}
