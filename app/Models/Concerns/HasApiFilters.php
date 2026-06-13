<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasApiFilters
{
    /**
     * Apply optional field filters from validated request data.
     *
     * Text fields: LIKE %value%
     * Exact fields: = value
     * Date fields: >= {col}_desde, <= {col}_hasta
     *
     * @param  Builder<static>  $query
     * @param  array<string, mixed>  $filters
     * @return Builder<static>
     */
    public function scopeApplyFilters(Builder $query, array $filters): Builder
    {
        foreach ($this->filterableText ?? [] as $column) {
            $value = $filters[$column] ?? null;
            $query->when(
                $value !== null && $value !== '',
                fn (Builder $q) => $q->where($column, 'like', "%{$value}%")
            );
        }

        foreach ($this->filterableExact ?? [] as $column) {
            $value = $filters[$column] ?? null;
            $query->when(
                $value !== null && $value !== '',
                fn (Builder $q) => $q->where($column, $value)
            );
        }

        foreach ($this->filterableDate ?? [] as $column) {
            $desde = $filters["{$column}_desde"] ?? null;
            $hasta = $filters["{$column}_hasta"] ?? null;
            $query->when(
                $desde !== null && $desde !== '',
                fn (Builder $q) => $q->whereDate($column, '>=', $desde)
            );
            $query->when(
                $hasta !== null && $hasta !== '',
                fn (Builder $q) => $q->whereDate($column, '<=', $hasta)
            );
        }

        return $query;
    }
}
