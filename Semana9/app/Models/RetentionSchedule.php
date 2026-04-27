<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'series_id',
    'subseries_id',
    'tramite_years',
    'concentracion_years',
    'is_administrative',
    'is_legal',
    'is_fiscal_or_accounting',
    'is_evidential',
    'is_testimonial',
    'is_informative',
    'final_disposition',
    'legal_basis',
    'notes',
])]
class RetentionSchedule extends Model
{
    protected function casts(): array
    {
        return [
            'is_administrative' => 'bool',
            'is_legal' => 'bool',
            'is_fiscal_or_accounting' => 'bool',
            'is_evidential' => 'bool',
            'is_testimonial' => 'bool',
            'is_informative' => 'bool',
        ];
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(ArchivalSeries::class, 'series_id');
    }

    public function subseries(): BelongsTo
    {
        return $this->belongsTo(ArchivalSubseries::class, 'subseries_id');
    }
}
