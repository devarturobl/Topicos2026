<?php

namespace App\Filament\Resources\ArchivalFiles\Pages;

use App\Filament\Resources\ArchivalFiles\ArchivalFileResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditArchivalFile extends EditRecord
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
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
