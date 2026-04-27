<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'archival_file_id',
    'classification_date',
    'classified_by_area',
    'reserved_sections',
    'reservation_period',
    'reservation_legal_basis',
    'reservation_extension',
    'confidential_sections',
    'confidential_legal_basis',
    'declassified_at',
    'declassification_notes',
])]
class FileAccessControl extends Model
{
    protected function casts(): array
    {
        return [
            'classification_date' => 'date',
            'declassified_at' => 'date',
        ];
    }

    public function archivalFile(): BelongsTo
    {
        return $this->belongsTo(ArchivalFile::class, 'archival_file_id');
    }
}
