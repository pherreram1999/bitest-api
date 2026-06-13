<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\PlanEstudio;
use App\Models\UnidadAprendizaje;
use Illuminate\Database\Seeder;

class UnidadAprendizajeObligatoriaSeeder extends Seeder
{
    public function run(): void
    {
        $carrera = Carrera::where('nombre', 'Ingeniería en Sistemas Computacionales')->first();
        $plan = PlanEstudio::where('nombre', 'ISC 2020')->first();

        if (! $carrera || ! $plan) {
            $this->command->warn('Carrera ISC o Plan ISC 2020 no encontrados. Saltando UnidadAprendizajeObligatoriaSeeder.');

            return;
        }

        $unidades = [
            1 => [
                'Cálculo',
                'Análisis Vectorial',
                'Matemáticas Discretas',
                'Comunicación Oral y Escrita',
                'Fundamentos de Programación',
            ],
            2 => [
                'Álgebra Lineal',
                'Cálculo Aplicado',
                'Mecánica y Electromagnetismo',
                'Ingeniería, Ética y Sociedad',
                'Fundamentos Económicos',
                'Algoritmos y Estructuras de Datos',
            ],
            3 => [
                'Ecuaciones Diferenciales',
                'Circuitos Eléctricos',
                'Fundamentos de Diseño Digital',
                'Bases de Datos',
                'Finanzas Empresariales',
                'Paradigmas de Programación',
                'Análisis y Diseño de Algoritmos',
            ],
            4 => [
                'Probabilidad y Estadística',
                'Matemáticas Avanzadas para la Ingeniería',
                'Electrónica Analógica',
                'Diseño de Sistemas Digitales',
                'Tecnologías para el Desarrollo de Aplicaciones Web',
                'Sistemas Operativos',
                'Teoría de la Computación',
            ],
            5 => [
                'Procesamiento Digital de Señales',
                'Instrumentación y Control',
                'Arquitectura de Computadoras',
                'Análisis y Diseño de Sistemas',
                'Formulación y Evaluación de Proyectos Informáticos',
                'Compiladores',
                'Redes de Computadoras',
            ],
            6 => [
                'Sistemas en Chip',
                'Métodos Cuantitativos para la Toma de Decisiones',
                'Ingeniería de Software',
                'Inteligencia Artificial',
                'Aplicaciones para Comunicaciones en Red',
            ],
            7 => [
                'Desarrollo de Aplicaciones Móviles Nativas',
                'Trabajo Terminal I',
                'Sistemas Distribuidos',
                'Administración de Servicios en Red',
            ],
            8 => [
                'Estancia Profesional',
                'Desarrollo de Habilidades Sociales para la Alta Dirección',
                'Trabajo Terminal II',
                'Gestión Empresarial',
                'Liderazgo Personal',
            ],
        ];

        foreach ($unidades as $semestre => $nombres) {
            foreach ($nombres as $nombre) {
                UnidadAprendizaje::firstOrCreate(
                    [
                        'nombre' => $nombre,
                        'carrera_id' => $carrera->id,
                        'plan_estudio_id' => $plan->id,
                    ],
                    [
                        'semestre' => $semestre,
                    ],
                );
            }
        }
    }
}
