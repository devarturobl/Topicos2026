<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['section_id', 'subsection_id', 'code', 'name', 'description'])]
class ArchivalSeries extends Model
{
    public function section(): BelongsTo
    {
        return $this->belongsTo(ArchivalSection::class, 'section_id');
    }

    public function subsection(): BelongsTo
    {
        return $this->belongsTo(ArchivalSubsection::class, 'subsection_id');
    }

    public function subseries(): HasMany
    {
        return $this->hasMany(ArchivalSubseries::class, 'series_id');
    }

    public function retentionSchedule(): HasOne
    {
        return $this->hasOne(RetentionSchedule::class, 'series_id');
    }
}
