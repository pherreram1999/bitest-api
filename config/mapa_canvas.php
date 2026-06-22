<?php

/**
 * Layout estático del plano del campus ESCOM (IPN).
 * Fuente: resources/docs/escom_build.jpeg
 *
 * Sistema de coordenadas: píxeles lógicos sobre un canvas de 1024×560.
 * Flutter escala con: scale = min(size.width / canvas.width, size.height / canvas.height)
 *
 * Elementos con type='building' tienen clave 'edificio' con el nombre EXACTO en DB.
 * El controlador los resuelve a 'edificio_id' en runtime (un solo query).
 * Elementos decorativos (type='zone','wall','label','marker') no tienen 'edificio'.
 */

return [

    'canvas' => [
        'width'      => 1024,
        'height'     => 560,
        'background' => '#F5F5F5',
        'padding'    => 8,
    ],

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    | type: 'wall' | 'building' | 'zone' | 'tag' | 'label' | 'marker'
    |
    | wall     → borde exterior del campus; rect obligatorio
    | building → edificio real con salones; rect + label obligatorios; 'edificio' = nombre en DB
    | zone     → área decorativa sin salones; rect obligatorio (style='label-only' → solo texto)
    | tag      → etiqueta de salones pegada a un edificio (ej. "Salones 2XYZ"); point
    | label    → texto libre; point
    | marker   → pin "Usted está aquí"; point
    */
    'elements' => [

        // ── Muro exterior ──────────────────────────────────────────────────
        [
            'type' => 'wall',
            'rect' => ['x' => 8, 'y' => 8, 'w' => 1008, 'h' => 544],
        ],

        // ── Entrada/Salida ─────────────────────────────────────────────────
        [
            'type'  => 'label',
            'text'  => 'E/S',
            'point' => ['x' => 512, 'y' => 8],
        ],

        // ── Fila norte: Edificio 2 + Edificio 4 ───────────────────────────
        [
            'type'       => 'building',
            'edificio'   => 'Edificio 2',
            'rect'       => ['x' => 328, 'y' => 22, 'w' => 224, 'h' => 78],
        ],
        [
            'type'  => 'tag',
            'text'  => 'Salones 2XYZ',
            'point' => ['x' => 328, 'y' => 104],
        ],
        [
            'type'       => 'building',
            'edificio'   => 'Edificio 4',
            'rect'       => ['x' => 576, 'y' => 22, 'w' => 224, 'h' => 78],
        ],
        [
            'type'  => 'tag',
            'text'  => 'Salones 2XYZ',
            'point' => ['x' => 576, 'y' => 104],
        ],
        [
            'type'  => 'tag',
            'text'  => 'Salones 4XYZ',
            'point' => ['x' => 844, 'y' => 22],
        ],

        // ── Fila media: Auditorio · Gob · Explanada · Labs · Edificio 5 ───
        [
            'type'  => 'zone',
            'label' => 'Auditorio',
            'rect'  => ['x' => 18, 'y' => 130, 'w' => 118, 'h' => 120],
        ],
        [
            'type'       => 'building',
            'edificio'   => 'Edificio de Gobierno',
            'rect'       => ['x' => 150, 'y' => 122, 'w' => 152, 'h' => 200],
        ],
        [
            'type'  => 'zone',
            'label' => 'Explanada',
            'style' => 'label-only',
            'rect'  => ['x' => 316, 'y' => 130, 'w' => 164, 'h' => 192],
        ],
        [
            'type'       => 'building',
            'edificio'   => 'Edificio de Laboratorios',
            'rect'       => ['x' => 494, 'y' => 122, 'w' => 186, 'h' => 200],
        ],
        [
            'type'       => 'building',
            'edificio'   => 'Edificio 5',
            'rect'       => ['x' => 726, 'y' => 122, 'w' => 270, 'h' => 200],
        ],
        [
            'type'  => 'tag',
            'text'  => 'Salones 3XYZ',
            'point' => ['x' => 844, 'y' => 306],
        ],

        // ── Marcador de posición ───────────────────────────────────────────
        [
            'type'  => 'marker',
            'label' => 'Usted está aquí',
            'point' => ['x' => 308, 'y' => 158],
        ],

        // ── Fila sur: Área estudio · Edificio 1 · Edificio 3 · Dep. ──────
        [
            'type'  => 'zone',
            'label' => 'Área de estudio',
            'rect'  => ['x' => 18, 'y' => 344, 'w' => 196, 'h' => 100],
        ],
        [
            'type'       => 'building',
            'edificio'   => 'Edificio 1',
            'rect'       => ['x' => 328, 'y' => 344, 'w' => 176, 'h' => 90],
        ],
        [
            'type'  => 'tag',
            'text'  => 'Salones 1XYZ',
            'point' => ['x' => 328, 'y' => 438],
        ],
        [
            'type'       => 'building',
            'edificio'   => 'Edificio 3',
            'rect'       => ['x' => 528, 'y' => 344, 'w' => 176, 'h' => 90],
        ],
        [
            'type'  => 'tag',
            'text'  => 'Salones 1XYZ',
            'point' => ['x' => 528, 'y' => 438],
        ],
        [
            'type'  => 'zone',
            'label' => 'Área Deportiva',
            'rect'  => ['x' => 844, 'y' => 344, 'w' => 160, 'h' => 100],
        ],

        // ── Fila inferior interior: Dep. Izq. · Barra · Cafetería ─────────
        [
            'type'  => 'zone',
            'label' => 'Área Deportiva',
            'rect'  => ['x' => 18, 'y' => 448, 'w' => 196, 'h' => 94],
        ],
        [
            'type'  => 'zone',
            'label' => 'Barra de Café',
            'rect'  => ['x' => 222, 'y' => 462, 'w' => 100, 'h' => 68],
        ],
        [
            'type'  => 'zone',
            'label' => 'Cafetería',
            'rect'  => ['x' => 844, 'y' => 448, 'w' => 160, 'h' => 94],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Style tokens — para que Flutter no hardcodee colores/tamaños
    |--------------------------------------------------------------------------
    */
    'style' => [
        'building' => [
            'fill'         => '#FFFFFF',
            'stroke'       => '#1A1A1A',
            'stroke_width' => 2.0,
            'corner_radius' => 4.0,
            'text'         => [
                'size'   => 14,
                'weight' => 'bold',
                'color'  => '#1A1A1A',
                'align'  => 'center',
            ],
        ],
        'zone' => [
            'fill'         => '#EFEFEF',
            'stroke'       => '#1A1A1A',
            'stroke_width' => 1.5,
            'corner_radius' => 3.0,
            'text'         => [
                'size'   => 11,
                'weight' => 'normal',
                'color'  => '#1A1A1A',
                'align'  => 'center',
            ],
        ],
        'wall' => [
            'fill'         => 'transparent',
            'stroke'       => '#1A1A1A',
            'stroke_width' => 2.5,
            'corner_radius' => 0.0,
        ],
        'tag' => [
            'fill'       => '#7A1F3D',
            'text_color' => '#FFFFFF',
            'text_size'  => 9,
            'padding_h'  => 6,
            'padding_v'  => 3,
            'corner_radius' => 2.0,
        ],
        'label' => [
            'text'   => [
                'size'   => 11,
                'weight' => 'bold',
                'color'  => '#1A1A1A',
                'align'  => 'center',
            ],
        ],
        'marker' => [
            'color'  => '#2C6FB5',
            'radius' => 10.0,
        ],
        'highlight' => [
            'fill'   => '#D4E8FF',
            'stroke' => '#2C6FB5',
        ],
    ],

];
