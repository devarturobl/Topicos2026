<?php

namespace App\Filament\Resources\ArchivalSubseries\Pages;

use App\Filament\Resources\ArchivalSubseries\ArchivalSubseriesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArchivalSubseries extends ListRecords
{
    protected static string $resource = ArchivalSubseriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
