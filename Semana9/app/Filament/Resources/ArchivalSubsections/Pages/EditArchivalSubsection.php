<?php

namespace App\Filament\Resources\ArchivalSubsections\Pages;

use App\Filament\Resources\ArchivalSubsections\ArchivalSubsectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArchivalSubsection extends EditRecord
{
    protected static string $resource = ArchivalSubsectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
