<?php

namespace Database\Seeders;

use App\Models\Edificio;
use App\Models\Salon;
use Illuminate\Database\Seeder;

class SalonSeeder extends Seeder
{
    public function run(): void
    {
        $mapa = [
            'Edificio 1' => [
                'UTEYCV 1001',
                'Salón 1002',
                'Computer Science Laboratory 1003',
                'Artificial Life Robotic Lab 1004',
                'CELEX 1005',
                'Salón 1006',
                'Salón 1007',
                'Unidad de Informática 1101',
                'Salón 1102',
                'Sala de Impresiones 1103',
                'Laboratorio de Redes 1104',
                'Laboratorio de Cómputo 1105',
                'Laboratorio de Cómputo 1106',
                'Laboratorio de Cómputo 1107',
                'Cubículos de Profesores 1201',
                'Salón 1202',
                'Salón 1203',
                'Salón 1204',
                'Salón 1205',
                'Salón 1206',
                'Salón 1207',
            ],
            'Edificio 2' => [
                'Salón 2001',
                'Salón 2002',
                'Salón 2003',
                'Salón 2004',
                'Salón 2005',
                'Salón 2006',
                'Salón 2007',
                'Cubículos de Profesores 2101',
                'Laboratorio de Innovación Tecnológica 2102',
                'Laboratorio de Innovación Tecnológica 2103',
                'Laboratorio de Cómputo 2104',
                'Laboratorio de Cómputo 2105',
                'Laboratorio de Cómputo 2106',
                'Laboratorio de Cómputo 2107',
                'Cubículos de Profesores 2201',
                'Salón 2202',
                'Salón 2203',
                'Salón 2204',
                'Salón 2205',
                'Salón 2206',
                'Salón 2207',
            ],
            'Edificio 3' => [
                'Club de Biorobótica 1008',
                'Sala de TT 1009',
                'Almacén 1010',
                'Salón 1011',
                'Salón 1012',
                'Salón 1013',
                'Salón 1014',
                'Decanato 1108',
                'Laboratorio 1109',
                'Salón 1110',
                'Salón 1111',
                'Salón 1112',
                'Salón 1113',
                'Salón 1114',
                'Club de Programación 1208',
                'Salón 1209',
                'Salón 1210',
                'Salón 1211',
                'Salón 1212',
                'Salón 1213',
                'Salón 1214',
            ],
            'Edificio 4' => [
                'Sección de Estudios de Posgrado e Investigación 2008',
                'Laboratorio de Cómputo (Posgrado) 2009',
                'Laboratorio de Cómputo (Posgrado) 2010',
                'Laboratorio de Posgrado 2011',
                'Laboratorio de ISISA 2012',
                'Cubículos de Profesores (DISC) 2108',
                'Salón 2109',
                'Salón 2110',
                'Salón 2111',
                'Salón 2112',
                'Salón 2113',
                'Departamento de Formación Básica - Cubículos de Profesores 2208',
                'Salón 2209',
                'Salón 2210',
                'Salón 2211',
                'Salón 2212',
                'Salón 2213',
            ],
            'Edificio 5' => [
                // Ala 4 (PB)
                'Salón 4008',
                'Salón 4009',
                'Salón 4010',
                'Salón 4011',
                'Laboratorio 4012',
                'Laboratorio 4013',
                // Ala 4 (P1)
                'Salón 4108',
                'Salón 4109',
                'Salón 4110',
                'Salón 4111',
                'Salón 4112',
                'Salón 4113',
                // Ala 4 (P2)
                'Salón 4208',
                'Salón 4209',
                'Salón 4210',
                'Salón 4211',
                'Salón 4212',
                'Salón 4213',
                // Ala 3 (PB)
                'Salón 3008',
                'Salón 3009',
                'Salón 3010',
                'Salón 3011',
                'Laboratorio 3012',
                'Laboratorio 3013',
                // Ala 3 (P1)
                'Salón 3108',
                'Salón 3109',
                'Salón 3110',
                'Salón 3111',
                'Salón 3112',
                'Salón 3113',
                // Ala 3 (P2)
                'Salón 3208',
                'Salón 3209',
                'Salón 3210',
                'Salón 3211',
                'Salón 3212',
                'Salón 3213',
            ],
            'Edificio de Laboratorios' => [
                'Sala "Eduardo Torrijos Ocadiz"',
                'Laboratorio de Física',
                'Laboratorio de Sistemas Digitales 1',
                'Laboratorio de Sistemas Digitales 2',
                'Laboratorio de Electrónica Analógica 1',
                'Laboratorio de Electrónica Analógica 2',
                'Laboratorio 1',
                'Laboratorio 2',
                'Laboratorio 3',
                'Sala de TT 1',
                'Sala de TT 2',
                'Sala de TT 3',
                'Sala de TT 4',
                'Sala de TT 5',
                'Sala de TT 6',
                'Sala de TT 7',
                'Sala de TT 8',
                'Cubículos de Profesores 1',
                'Cubículos de Profesores 2',
                'Cubículos de Profesores 3',
                'Cubículos de Profesores 4',
                'Cubículos de Profesores 5',
                'Cubículos de Profesores 6',
                'Depto. de Ingeniería en Sistemas Computacionales',
                'Depto. de Ciencias e Ingeniería de la Computación',
                'Sindicato PAAE/Docente',
                'Club de Hemeroteca',
            ],
            'Edificio de Gobierno' => [
                'Lobby',
                'Departamento de Servicios Estudiantiles',
                'Sala del Consejo Técnico Consultivo Escolar',
                'Coordinación de Enlace y Gestión Técnica',
                'Departamento de Materiales y Servicios',
                'Departamento de Recursos Financieros',
                'Departamento de Capital Humano',
                'Subdirección Administrativa',
                'Dirección',
                'Subdirección Académica',
                'Subdirección de Servicios Educativos e Integración Social',
                'Coordinación de Equidad de Género',
                'Depto. de Innovación Educativa',
                'Unidad Politécnica de Integración Social',
                'Depto. de Extensión y Apoyos Educativos',
                'Departamento de Gestión Escolar',
                'Servicios de Salud',
                'Reloj Checador',
                'Cajero BBVA',
                'Biblioteca',
            ],
        ];

        foreach ($mapa as $edificioNombre => $salones) {
            $edificio = Edificio::where('nombre', $edificioNombre)->first();

            if (! $edificio) {
                $this->command->warn("Edificio no encontrado: {$edificioNombre}");

                continue;
            }

            if (empty($salones)) {
                Salon::firstOrCreate([
                    'nombre'      => "{$edificioNombre} - General",
                    'edificio_id' => $edificio->id,
                ]);

                continue;
            }

            foreach ($salones as $nombre) {
                Salon::firstOrCreate([
                    'nombre'      => $nombre,
                    'edificio_id' => $edificio->id,
                ]);
            }
        }
    }
}
