<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'type',
    'origin_unit_id',
    'destination_unit_id',
    'status',
    'transfer_date',
    'notes',
])]
class Transfer extends Model
{
    protected function casts(): array
    {
        return [
            'transfer_date' => 'date',
        ];
    }

    public function originUnit(): BelongsTo
    {
        return $this->belongsTo(AdministrativeUnit::class, 'origin_unit_id');
    }

    public function destinationUnit(): BelongsTo
    {
        return $this->belongsTo(AdministrativeUnit::class, 'destination_unit_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransferItem::class);
    }
}
