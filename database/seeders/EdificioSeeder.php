<?php

namespace Database\Seeders;

use App\Models\Edificio;
use Illuminate\Database\Seeder;

class EdificioSeeder extends Seeder
{
    public function run(): void
    {
        $edificios = [
            'Edificio 1',
            'Edificio 2',
            'Edificio 3',
            'Edificio 4',
            'Edificio 5',
            'Edificio de Laboratorios',
            'Edificio de Gobierno',
        ];

        foreach ($edificios as $nombre) {
            Edificio::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
