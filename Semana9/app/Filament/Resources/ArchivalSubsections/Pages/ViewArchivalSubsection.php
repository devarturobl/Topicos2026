<?php

namespace App\Filament\Resources\ArchivalSubsections\Pages;

use App\Filament\Resources\ArchivalSubsections\ArchivalSubsectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArchivalSubsection extends ViewRecord
{
    protected static string $resource = ArchivalSubsectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
