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
 * @property string $clave
 * @property string|null $observaciones
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, Profesor> $profesores
 */
#[Fillable(['nombre', 'clave', 'observaciones'])]
class Area extends Model
{
    use HasApiFilters, SoftDeletes;

    /** @var array<int, string> */
    protected array $filterableText = ['nombre', 'clave', 'observaciones'];

    /**
     * Profesores del área.
     *
     * @return HasMany<Profesor, $this>
     */
    public function profesores(): HasMany
    {
        return $this->hasMany(Profesor::class);
    }
}
