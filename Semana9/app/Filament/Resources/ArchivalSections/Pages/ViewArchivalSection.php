<?php

namespace App\Filament\Resources\ArchivalSections\Pages;

use App\Filament\Resources\ArchivalSections\ArchivalSectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArchivalSection extends ViewRecord
{
    protected static string $resource = ArchivalSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
