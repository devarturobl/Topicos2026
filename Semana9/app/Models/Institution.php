<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'siglas', 'logo_path', 'is_active'])]
class Institution extends Model
{
    public function administrativeUnits(): HasMany
    {
        return $this->hasMany(AdministrativeUnit::class);
    }

    public function archivalFiles(): HasMany
    {
        return $this->hasMany(ArchivalFile::class);
    }
}
