<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        Area::firstOrCreate(
            ['nombre' => 'Docentes'],
            [
                'clave' => 'DOC',
                'observaciones' => null,
            ],
        );
    }
}
