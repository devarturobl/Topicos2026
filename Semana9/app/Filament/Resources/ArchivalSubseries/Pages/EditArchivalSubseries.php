<?php

namespace App\Filament\Resources\ArchivalSubseries\Pages;

use App\Filament\Resources\ArchivalSubseries\ArchivalSubseriesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArchivalSubseries extends EditRecord
{
    protected static string $resource = ArchivalSubseriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
