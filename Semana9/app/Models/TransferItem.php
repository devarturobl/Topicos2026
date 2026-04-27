<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['transfer_id', 'archival_file_id'])]
class TransferItem extends Model
{
    public function transfer(): BelongsTo
    {
        return $this->belongsTo(Transfer::class);
    }

    public function archivalFile(): BelongsTo
    {
        return $this->belongsTo(ArchivalFile::class, 'archival_file_id');
    }
}
