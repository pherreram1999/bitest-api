<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\PlanEstudio;
use App\Models\UnidadAprendizaje;
use Illuminate\Database\Seeder;

class UnidadAprendizajeOptativaSeeder extends Seeder
{
    public function run(): void
    {
        $carrera = Carrera::where('nombre', 'Ingeniería en Sistemas Computacionales')->first();
        $plan = PlanEstudio::where('nombre', 'ISC 2020')->first();

        if (! $carrera || ! $plan) {
            $this->command->warn('Carrera ISC o Plan ISC 2020 no encontrados. Saltando UnidadAprendizajeOptativaSeeder.');

            return;
        }

        $unidades = [
            'Criptografía',
            'Gobierno de TI',
            'Tópicos Selectos de Alta Tecnología',
            'Selected Topics I de Computación',
            'Selected Topics II de Computación',
            'Gestión de Empresas de Alta Tecnología',
            'Visión por Computadora',
            'Desarrollo de Aplicaciones Web',
            'Minería de Datos',
            'Internet de las Cosas',
            'Instrumentación Virtual',
            'Aprendizaje de Máquina',
            'Calidad de Software',
            'Herramientas Estadísticas para el Análisis de Datos',
            'Sistemas Embebidos',
            'Sistemas Complejos',
            'Algoritmos Bioinspirados',
            'Realidad Virtual y Aumentada',
            'Procesamiento de Lenguaje Natural',
            'Autómatas Celulares',
            'Computación Gráfica',
            'Algoritmos Genéticos',
            'Bases de Datos No Relacionales',
            'Big Data',
        ];

        foreach ($unidades as $nombre) {
            UnidadAprendizaje::firstOrCreate(
                [
                    'nombre' => $nombre,
                    'carrera_id' => $carrera->id,
                    'plan_estudio_id' => $plan->id,
                ],
                [
                    'semestre' => 6,
                ],
            );
        }
    }
}
