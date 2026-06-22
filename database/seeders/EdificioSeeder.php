<?php

namespace Database\Seeders;

use App\Models\Edificio;
use Illuminate\Database\Seeder;

class EdificioSeeder extends Seeder
{
    public function run(): void
    {
        $edificios = [
            ['numero' => 1, 'nombre' => 'Edificio 1'],
            ['numero' => 2, 'nombre' => 'Edificio 2'],
            ['numero' => 3, 'nombre' => 'Edificio 3'],
            ['numero' => 4, 'nombre' => 'Edificio 4'],
            ['numero' => 5, 'nombre' => 'Edificio 5'],
            ['numero' => 6, 'nombre' => 'Edificio de Laboratorios'],
            ['numero' => 7, 'nombre' => 'Edificio de Gobierno'],
        ];

        foreach ($edificios as $edificio) {
            Edificio::firstOrCreate(
                ['numero' => $edificio['numero']],
                ['nombre' => $edificio['nombre']]
            );
        }
    }
}
