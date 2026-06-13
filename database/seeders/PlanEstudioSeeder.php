<?php

namespace Database\Seeders;

use App\Models\PlanEstudio;
use Illuminate\Database\Seeder;

class PlanEstudioSeeder extends Seeder
{
    public function run(): void
    {
        PlanEstudio::firstOrCreate(
            ['nombre' => 'ISC 2020'],
            [
                'periodo_inicial' => '2020-08-01',
                'periodo_final' => '2030-12-31',
            ],
        );
    }
}
