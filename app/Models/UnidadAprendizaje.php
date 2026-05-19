<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $nombre
 * @property int $carrera_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Carrera $carrera
 * @property-read Collection<int, Examen> $examenes
 */
#[Fillable(['nombre', 'carrera_id'])]
class UnidadAprendizaje extends Model
{
    protected $table = 'unidades_aprendizaje';

    /**
     * Carrera a la que pertenece la unidad de aprendizaje.
     *
     * @return BelongsTo<Carrera, $this>
     */
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

    /**
     * Exámenes de la unidad de aprendizaje.
     *
     * @return HasMany<Examen, $this>
     */
    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class);
    }
}
