<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'archival_file_id',
    'type',
    'from_phase',
    'to_phase',
    'performed_at',
    'performed_by',
    'notes',
])]
class FileMovement extends Model
{
    protected function casts(): array
    {
        return [
            'performed_at' => 'datetime',
        ];
    }

    public function archivalFile(): BelongsTo
    {
        return $this->belongsTo(ArchivalFile::class, 'archival_file_id');
    }
}
