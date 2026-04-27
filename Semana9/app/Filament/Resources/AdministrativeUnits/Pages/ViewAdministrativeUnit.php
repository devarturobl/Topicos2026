<?php

namespace App\Filament\Resources\AdministrativeUnits\Pages;

use App\Filament\Resources\AdministrativeUnits\AdministrativeUnitResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAdministrativeUnit extends ViewRecord
{
    protected static string $resource = AdministrativeUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
