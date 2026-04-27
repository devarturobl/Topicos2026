<?php

namespace App\Filament\Resources\ArchivalSubsections\Pages;

use App\Filament\Resources\ArchivalSubsections\ArchivalSubsectionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArchivalSubsections extends ListRecords
{
    protected static string $resource = ArchivalSubsectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
