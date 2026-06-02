<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @php
                $groups = [
                    'Auth' => [
                        ['label' => 'Usuarios',              'href' => '/admin/users'],
                    ],
                    'Académico' => [
                        ['label' => 'Carreras',              'href' => '/admin/carreras'],
                        ['label' => 'Planes de Estudio',     'href' => '/admin/plan-estudios'],
                        ['label' => 'Unidades de Aprendizaje', 'href' => '/admin/unidad-aprendizajes'],
                    ],
                    'Infraestructura' => [
                        ['label' => 'Edificios',             'href' => '/admin/edificios'],
                        ['label' => 'Salones',               'href' => '/admin/salons'],
                    ],
                    'Personal' => [
                        ['label' => 'Áreas',                 'href' => '/admin/areas'],
                        ['label' => 'Profesores',            'href' => '/admin/profesors'],
                    ],
                    'Evaluación' => [
                        ['label' => 'Exámenes',              'href' => '/admin/examens'],
                    ],
                ];
            @endphp

            @foreach ($groups as $group => $items)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-6 pt-5 pb-2">
                        <h3 class="text-xs font-semibold uppercase tracking-widest text-gray-400">{{ $group }}</h3>
                    </div>
                    <div class="px-6 pb-6 flex flex-wrap gap-3">
                        @foreach ($items as $item)
                            <a href="{{ $item['href'] }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
