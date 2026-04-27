<?php

namespace App\Filament\Resources\RetentionSchedules\Pages;

use App\Filament\Resources\RetentionSchedules\RetentionScheduleResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRetentionSchedule extends EditRecord
{
    protected static string $resource = RetentionScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
