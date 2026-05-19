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
 * @property int $edificio_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Edificio $edificio
 * @property-read Collection<int, Examen> $examenes
 */
#[Fillable(['nombre', 'edificio_id'])]
class Salon extends Model
{
    protected $table = 'salones';

    /**
     * Edificio al que pertenece el salón.
     *
     * @return BelongsTo<Edificio, $this>
     */
    public function edificio(): BelongsTo
    {
        return $this->belongsTo(Edificio::class);
    }

    /**
     * Exámenes programados en el salón.
     *
     * @return HasMany<Examen, $this>
     */
    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class);
    }
}
