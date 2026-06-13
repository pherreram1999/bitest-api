<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        Carrera::firstOrCreate(
            ['nombre' => 'Ingeniería en Sistemas Computacionales'],
        );
    }
}
