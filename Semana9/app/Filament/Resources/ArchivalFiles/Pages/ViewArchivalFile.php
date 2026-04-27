<?php

namespace App\Filament\Resources\ArchivalFiles\Pages;

use App\Filament\Resources\ArchivalFiles\ArchivalFileResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArchivalFile extends ViewRecord
{
    protected static string $resource = ArchivalFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cover')
                ->label('Portada')
                ->icon('heroicon-o-printer')
                ->url(fn (): string => route('archival-files.cover', $this->record))
                ->openUrlInNewTab(),
            EditAction::make(),
        ];
    }
}
