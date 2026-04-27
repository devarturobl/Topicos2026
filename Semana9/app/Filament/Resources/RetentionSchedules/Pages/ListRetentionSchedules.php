<?php

namespace App\Filament\Resources\RetentionSchedules\Pages;

use App\Filament\Resources\RetentionSchedules\RetentionScheduleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRetentionSchedules extends ListRecords
{
    protected static string $resource = RetentionScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
