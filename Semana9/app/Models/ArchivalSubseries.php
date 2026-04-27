<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['series_id', 'code', 'name', 'description'])]
class ArchivalSubseries extends Model
{
    public function series(): BelongsTo
    {
        return $this->belongsTo(ArchivalSeries::class, 'series_id');
    }

    public function retentionSchedule(): HasOne
    {
        return $this->hasOne(RetentionSchedule::class, 'subseries_id');
    }

    public function archivalFiles(): HasMany
    {
        return $this->hasMany(ArchivalFile::class, 'subseries_id');
    }
}
