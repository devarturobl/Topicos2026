<?php

namespace App\Filament\Resources\ArchivalSeries\Pages;

use App\Filament\Resources\ArchivalSeries\ArchivalSeriesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArchivalSeries extends ListRecords
{
    protected static string $resource = ArchivalSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
