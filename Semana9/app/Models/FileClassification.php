<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'archival_file_id',
    'is_administrative',
    'is_legal',
    'is_fiscal_or_accounting',
    'is_evidential',
    'is_testimonial',
    'is_informative',
    'tramite_years',
    'concentracion_years',
])]
class FileClassification extends Model
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

    public function archivalFile(): BelongsTo
    {
        return $this->belongsTo(ArchivalFile::class, 'archival_file_id');
    }
}
