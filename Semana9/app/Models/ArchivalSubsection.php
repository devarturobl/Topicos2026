<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['section_id', 'code', 'name', 'description'])]
class ArchivalSubsection extends Model
{
    public function section(): BelongsTo
    {
        return $this->belongsTo(ArchivalSection::class, 'section_id');
    }

    public function series(): HasMany
    {
        return $this->hasMany(ArchivalSeries::class, 'subsection_id');
    }
}
