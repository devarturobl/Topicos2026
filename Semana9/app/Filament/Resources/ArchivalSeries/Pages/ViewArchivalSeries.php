<?php

namespace App\Filament\Resources\ArchivalSeries\Pages;

use App\Filament\Resources\ArchivalSeries\ArchivalSeriesResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArchivalSeries extends ViewRecord
{
    protected static string $resource = ArchivalSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
