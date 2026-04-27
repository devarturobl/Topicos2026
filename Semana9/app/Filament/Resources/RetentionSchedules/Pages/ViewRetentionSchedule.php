<?php

namespace App\Filament\Resources\RetentionSchedules\Pages;

use App\Filament\Resources\RetentionSchedules\RetentionScheduleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRetentionSchedule extends ViewRecord
{
    protected static string $resource = RetentionScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
