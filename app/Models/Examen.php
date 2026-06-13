<?php

namespace App\Models;

use App\Models\Concerns\HasApiFilters;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $descripcion
 * @property Carbon $horario
 * @property bool $activo
 * @property int $user_id
 * @property int $unidad_aprendizaje_id
 * @property int $profesor_id
 * @property int $salon_id
 * @property Carbon|null $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $usuario
 * @property-read UnidadAprendizaje $unidadAprendizaje
 * @property-read Profesor $profesor
 * @property-read Salon $salon
 * @property-read Collection<int, User> $alumnos
 */
#[Fillable([
    'descripcion',
    'horario',
    'activo',
    'user_id',
    'unidad_aprendizaje_id',
    'profesor_id',
    'salon_id',
])]
class Examen extends Model
{
    use HasApiFilters, SoftDeletes;

    protected $table = 'examenes';

    /** @var array<int, string> */
    protected $with = ['usuario', 'unidadAprendizaje', 'profesor', 'salon'];

    /** @var array<int, string> */
    protected array $filterableText = ['descripcion'];

    /** @var array<int, string> */
    protected array $filterableExact = ['user_id', 'unidad_aprendizaje_id', 'profesor_id', 'salon_id'];

    /** @var array<int, string> */
    protected array $filterableDate = ['horario'];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'horario' => 'datetime',
            'activo' => 'boolean',
        ];
    }

    /**
     * Usuario que programó el examen.
     *
     * @return BelongsTo<User, $this>
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Unidad de aprendizaje evaluada.
     *
     * @return BelongsTo<UnidadAprendizaje, $this>
     */
    public function unidadAprendizaje(): BelongsTo
    {
        return $this->belongsTo(UnidadAprendizaje::class);
    }

    /**
     * Profesor que aplica el examen.
     *
     * @return BelongsTo<Profesor, $this>
     */
    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class);
    }

    /**
     * Salón donde se aplica el examen.
     *
     * @return BelongsTo<Salon, $this>
     */
    public function salon(): BelongsTo
    {
        return $this->belongsTo(Salon::class);
    }

    /**
     * Alumnos inscritos en el examen.
     *
     * @return BelongsToMany<User, $this>
     */
    public function alumnos(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'alumno_examen', 'examen_id', 'user_id')
            ->withTimestamps();
    }
}
