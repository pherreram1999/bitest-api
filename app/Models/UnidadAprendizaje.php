<?php

namespace App\Models;

use App\Models\Concerns\HasApiFilters;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $nombre
 * @property int|null $semestre
 * @property int $carrera_id
 * @property int $plan_estudio_id
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Carrera $carrera
 * @property-read PlanEstudio $planEstudio
 * @property-read Collection<int, Examen> $examenes
 */
#[Fillable(['nombre', 'semestre', 'carrera_id', 'plan_estudio_id'])]
class UnidadAprendizaje extends Model
{
    use HasApiFilters, SoftDeletes;

    protected $table = 'unidades_aprendizaje';

    /** @var array<int, string> */
    protected $with = ['carrera', 'planEstudio'];

    /** @var array<int, string> */
    protected array $filterableText = ['nombre'];

    /** @var array<int, string> */
    protected array $filterableExact = ['semestre', 'carrera_id', 'plan_estudio_id'];

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
     * Plan de estudios al que pertenece la unidad de aprendizaje.
     *
     * @return BelongsTo<PlanEstudio, $this>
     */
    public function planEstudio(): BelongsTo
    {
        return $this->belongsTo(PlanEstudio::class);
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
