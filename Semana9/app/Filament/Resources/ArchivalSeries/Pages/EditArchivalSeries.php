<?php

namespace App\Filament\Resources\ArchivalSeries\Pages;

use App\Filament\Resources\ArchivalSeries\ArchivalSeriesResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArchivalSeries extends EditRecord
{
    protected static string $resource = ArchivalSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
