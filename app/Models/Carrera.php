<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $nombre
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, PlanEstudio> $planes
 * @property-read Collection<int, UnidadAprendizaje> $unidades
 */
#[Fillable(['nombre'])]
class Carrera extends Model
{
    use SoftDeletes;

    /**
     * Planes de estudio pertenecientes a la carrera.
     *
     * @return HasMany<PlanEstudio, $this>
     */
    public function planes(): HasMany
    {
        return $this->hasMany(PlanEstudio::class);
    }

    /**
     * Unidades de aprendizaje de la carrera.
     *
     * @return HasMany<UnidadAprendizaje, $this>
     */
    public function unidades(): HasMany
    {
        return $this->hasMany(UnidadAprendizaje::class);
    }
}
