<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $nombre
 * @property Carbon $periodo_inicial
 * @property Carbon $periodo_final
 * @property int $carrera_id
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Carrera $carrera
 */
#[Fillable(['nombre', 'periodo_inicial', 'periodo_final', 'carrera_id'])]
class PlanEstudio extends Model
{
    use SoftDeletes;

    protected $table = 'planes_estudio';

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
     * Carrera a la que pertenece el plan de estudios.
     *
     * @return BelongsTo<Carrera, $this>
     */
    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }
}
