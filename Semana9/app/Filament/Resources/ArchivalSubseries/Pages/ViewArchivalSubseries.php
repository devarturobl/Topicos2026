<?php

namespace App\Filament\Resources\ArchivalSubseries\Pages;

use App\Filament\Resources\ArchivalSubseries\ArchivalSubseriesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArchivalSubseries extends ViewRecord
{
    protected static string $resource = ArchivalSubseriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
