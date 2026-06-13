<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unidades_aprendizaje', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedTinyInteger('semestre')->nullable();
            $table->foreignId('carrera_id')->constrained('carreras')->cascadeOnDelete();
            $table->foreignId('plan_estudio_id')->constrained('planes_estudio')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();

            $table->index('plan_estudio_id');
            $table->index(['plan_estudio_id', 'semestre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidades_aprendizaje');
    }
};
