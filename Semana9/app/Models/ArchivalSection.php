<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['code', 'name', 'description'])]
class ArchivalSection extends Model
{
    public function subsections(): HasMany
    {
        return $this->hasMany(ArchivalSubsection::class, 'section_id');
    }

    public function series(): HasMany
    {
        return $this->hasMany(ArchivalSeries::class, 'section_id');
    }
}
