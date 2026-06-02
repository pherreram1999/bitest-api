<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('examenes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->dateTime('horario');
            $table->unsignedTinyInteger('semestre');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('unidad_aprendizaje_id')->constrained('unidades_aprendizaje')->cascadeOnDelete();
            $table->foreignId('profesor_id')->constrained('profesores')->cascadeOnDelete();
            $table->foreignId('salon_id')->constrained('salones')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('examenes');
    }
};
