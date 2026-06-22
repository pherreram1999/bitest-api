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
 * @property int $numero
 * @property string $nombre
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, Salon> $salones
 */
#[Fillable(['numero', 'nombre'])]
class Edificio extends Model
{
    use HasApiFilters, SoftDeletes;

    /** @var array<int, string> */
    protected array $filterableText = ['nombre'];

    /** @var array<int, string> */
    protected array $filterableExact = ['numero'];

    /**
     * Usa `numero` como clave de resolución en route model binding,
     * para que /api/v1/edificios/{edificio} reciba el número del edificio.
     */
    public function getRouteKeyName(): string
    {
        return 'numero';
    }

    /**
     * Salones del edificio.
     *
     * @return HasMany<Salon, $this>
     */
    public function salones(): HasMany
    {
        return $this->hasMany(Salon::class);
    }
}
