<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $nombre
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, Salon> $salones
 */
#[Fillable(['nombre'])]
class Edificio extends Model
{
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
