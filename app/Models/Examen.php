<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $descripcion
 * @property Carbon $horario
 * @property int $semestre
 * @property int $user_id
 * @property int $unidad_aprendizaje_id
 * @property int $profesor_id
 * @property int $salon_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $usuario
 * @property-read UnidadAprendizaje $unidadAprendizaje
 * @property-read Profesor $profesor
 * @property-read Salon $salon
 */
#[Fillable([
    'descripcion',
    'horario',
    'semestre',
    'user_id',
    'unidad_aprendizaje_id',
    'profesor_id',
    'salon_id',
])]
class Examen extends Model
{
    protected $table = 'examenes';

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'horario' => 'datetime',
            'semestre' => 'integer',
        ];
    }

    /**
     * Usuario que programó el examen.
     *
     * @return BelongsTo<User, $this>
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Unidad de aprendizaje evaluada.
     *
     * @return BelongsTo<UnidadAprendizaje, $this>
     */
    public function unidadAprendizaje(): BelongsTo
    {
        return $this->belongsTo(UnidadAprendizaje::class);
    }

    /**
     * Profesor que aplica el examen.
     *
     * @return BelongsTo<Profesor, $this>
     */
    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class);
    }

    /**
     * Salón donde se aplica el examen.
     *
     * @return BelongsTo<Salon, $this>
     */
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }
}
