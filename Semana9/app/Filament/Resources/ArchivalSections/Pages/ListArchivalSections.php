<?php

namespace App\Filament\Resources\ArchivalSections\Pages;

use App\Filament\Resources\ArchivalSections\ArchivalSectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArchivalSections extends ListRecords
{
    protected static string $resource = ArchivalSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
