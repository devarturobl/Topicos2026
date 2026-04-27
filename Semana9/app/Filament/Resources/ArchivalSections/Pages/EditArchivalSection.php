<?php

namespace App\Filament\Resources\ArchivalSections\Pages;

use App\Filament\Resources\ArchivalSections\ArchivalSectionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArchivalSection extends EditRecord
{
    protected static string $resource = ArchivalSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
