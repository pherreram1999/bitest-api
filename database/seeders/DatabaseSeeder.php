<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CarreraSeeder::class,
            PlanEstudioSeeder::class,
            UnidadAprendizajeObligatoriaSeeder::class,
            UnidadAprendizajeOptativaSeeder::class,
            AreaSeeder::class,
            ProfesorSeeder::class,
            EdificioSeeder::class,
            SalonSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@bitets.mx',
            'password' => Hash::make('1205'),
            'rol' => 'admin',
            'identificador' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'identificador' => '20230001',
        ]);
    }
}
