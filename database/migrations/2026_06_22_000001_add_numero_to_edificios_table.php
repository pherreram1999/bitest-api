<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->unsignedInteger('numero')->nullable()->after('nombre');
            $table->unique(['numero', 'deleted_at']);
        });

        // Poblar filas existentes a partir del nombre del edificio.
        $map = [
            'Edificio 1' => 1,
            'Edificio 2' => 2,
            'Edificio 3' => 3,
            'Edificio 4' => 4,
            'Edificio 5' => 5,
            'Edificio de Laboratorios' => 6,
            'Edificio de Gobierno' => 7,
        ];

        foreach ($map as $nombre => $numero) {
            DB::table('edificios')
                ->where('nombre', $nombre)
                ->whereNull('numero')
                ->update(['numero' => $numero]);
        }

        // Cualquier fila restante sin número → asignación secuencial desde 8.
        $next = 8;
        DB::table('edificios')
            ->whereNull('numero')
            ->orderBy('id')
            ->get()
            ->each(function (object $row) use (&$next): void {
                DB::table('edificios')
                    ->where('id', $row->id)
                    ->update(['numero' => $next++]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('edificios', function (Blueprint $table) {
            $table->dropUnique(['numero', 'deleted_at']);
            $table->dropColumn('numero');
        });
    }
};
