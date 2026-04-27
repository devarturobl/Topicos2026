<?php

namespace App\Filament\Resources\ArchivalSubseries;

use App\Filament\Resources\ArchivalSubseries\Pages\CreateArchivalSubseries;
use App\Filament\Resources\ArchivalSubseries\Pages\EditArchivalSubseries;
use App\Filament\Resources\ArchivalSubseries\Pages\ListArchivalSubseries;
use App\Filament\Resources\ArchivalSubseries\Pages\ViewArchivalSubseries;
use App\Models\ArchivalSubseries;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ArchivalSubseriesResource extends Resource
{
    protected static ?string $model = ArchivalSubseries::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Catálogos archivísticos';

    protected static ?string $modelLabel = 'subserie';

    protected static ?string $pluralModelLabel = 'subseries';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subserie documental')
                    ->schema([
                        Select::make('series_id')
                            ->relationship('series', 'name')
                            ->label('Serie')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('code')
                            ->label('Código')
                            ->required()
                            ->maxLength(50),
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Descripción')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('series.name')->label('Serie'),
                TextEntry::make('code')->label('Código'),
                TextEntry::make('name')->label('Nombre'),
                TextEntry::make('description')->label('Descripción'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('series.name')
                    ->label('Serie')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArchivalSubseries::route('/'),
            'create' => CreateArchivalSubseries::route('/create'),
            'view' => ViewArchivalSubseries::route('/{record}'),
            'edit' => EditArchivalSubseries::route('/{record}/edit'),
        ];
    }
}
