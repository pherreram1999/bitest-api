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
 * @property string $email
 * @property int $area_id
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Area $area
 * @property-read Collection<int, Examen> $examenes
 */
#[Fillable(['nombre', 'email', 'area_id'])]
class Profesor extends Model
{
    use HasApiFilters, SoftDeletes;

    protected $table = 'profesores';

    /** @var array<int, string> */
    protected $with = ['area'];

    /** @var array<int, string> */
    protected array $filterableText = ['nombre', 'email'];

    /** @var array<int, string> */
    protected array $filterableExact = ['area_id'];

    /**
     * Área a la que pertenece el profesor.
     *
     * @return BelongsTo<Area, $this>
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Exámenes aplicados por el profesor.
     *
     * @return HasMany<Examen, $this>
     */
    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class);
    }
}
