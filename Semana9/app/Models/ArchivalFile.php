<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'institution_id',
    'administrative_unit_id',
    'section_id',
    'subsection_id',
    'series_id',
    'subseries_id',
    'file_code',
    'title',
    'description',
    'opened_at',
    'closed_at',
    'document_tradition',
    'document_support',
    'page_count',
    'legajo_total',
    'legajo_index',
    'status',
    'current_phase',
    'contains_reserved_info',
    'contains_confidential_info',
])]
class ArchivalFile extends Model
{
    protected function casts(): array
    {
        return [
            'opened_at' => 'date',
            'closed_at' => 'date',
            'contains_reserved_info' => 'bool',
            'contains_confidential_info' => 'bool',
        ];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function administrativeUnit(): BelongsTo
    {
        return $this->belongsTo(AdministrativeUnit::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(ArchivalSection::class, 'section_id');
    }

    public function subsection(): BelongsTo
    {
        return $this->belongsTo(ArchivalSubsection::class, 'subsection_id');
    }

    public function series(): BelongsTo
    {
        return $this->belongsTo(ArchivalSeries::class, 'series_id');
    }

    public function subseries(): BelongsTo
    {
        return $this->belongsTo(ArchivalSubseries::class, 'subseries_id');
    }

    public function classification(): HasOne
    {
        return $this->hasOne(FileClassification::class, 'archival_file_id');
    }

    public function accessControl(): HasOne
    {
        return $this->hasOne(FileAccessControl::class, 'archival_file_id');
    }

    public function movements(): HasMany
    {
        return $this->hasMany(FileMovement::class, 'archival_file_id');
    }

    public function transferItems(): HasMany
    {
        return $this->hasMany(TransferItem::class, 'archival_file_id');
    }

    public function getDocumentTraditionLabel(): string
    {
        return match ($this->document_tradition) {
            'original' => 'Original',
            'copia' => 'Copia',
            default => (string) $this->document_tradition,
        };
    }

    public function getDocumentSupportLabel(): string
    {
        return match ($this->document_support) {
            'papel' => 'Papel / fisico',
            'electronico' => 'Electronico',
            default => (string) $this->document_support,
        };
    }

    public function getCurrentPhaseLabel(): string
    {
        return match ($this->current_phase) {
            'tramite' => 'Tramite',
            'concentracion' => 'Concentracion',
            'historico' => 'Historico',
            default => (string) $this->current_phase,
        };
    }

    public function getStatusLabel(): string
    {
        return match ($this->status) {
            'abierto' => 'Abierto',
            'cerrado' => 'Cerrado',
            'en_tramite' => 'En tramite',
            'en_concentracion' => 'En concentracion',
            'historico' => 'Historico',
            'baja_autorizada' => 'Baja autorizada',
            'baja_ejecutada' => 'Baja ejecutada',
            default => (string) $this->status,
        };
    }

    public function getLegajoLabel(): string
    {
        return "{$this->legajo_index} de {$this->legajo_total}";
    }
}
