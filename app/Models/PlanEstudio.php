<?php

namespace App\Models;

use App\Models\Concerns\HasApiFilters;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $nombre
 * @property Carbon $periodo_inicial
 * @property Carbon $periodo_final
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, UnidadAprendizaje> $unidadesAprendizaje
 */
#[Fillable(['nombre', 'periodo_inicial', 'periodo_final'])]
class PlanEstudio extends Model
{
    use HasApiFilters, SoftDeletes;

    protected $table = 'planes_estudio';

    /** @var array<int, string> */
    protected array $filterableText = ['nombre'];

    /** @var array<int, string> */
    protected array $filterableDate = ['periodo_inicial', 'periodo_final'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'periodo_inicial' => 'date',
            'periodo_final' => 'date',
        ];
    }

    /**
     * Unidades de aprendizaje del plan.
     *
     * @return HasMany<UnidadAprendizaje, $this>
     */
    public function unidadesAprendizaje(): HasMany
    {
        return $this->hasMany(UnidadAprendizaje::class);
    }
}
