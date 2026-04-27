<?php

namespace App\Filament\Resources\ArchivalFiles\Pages;

use App\Filament\Resources\ArchivalFiles\ArchivalFileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArchivalFiles extends ListRecords
{
    protected static string $resource = ArchivalFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
