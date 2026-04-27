<?php

namespace App\Filament\Resources\ArchivalSeries;

use App\Filament\Resources\ArchivalSeries\Pages\CreateArchivalSeries;
use App\Filament\Resources\ArchivalSeries\Pages\EditArchivalSeries;
use App\Filament\Resources\ArchivalSeries\Pages\ListArchivalSeries;
use App\Filament\Resources\ArchivalSeries\Pages\ViewArchivalSeries;
use App\Models\ArchivalSeries;
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

class ArchivalSeriesResource extends Resource
{
    protected static ?string $model = ArchivalSeries::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Catálogos archivísticos';

    protected static ?string $modelLabel = 'serie';

    protected static ?string $pluralModelLabel = 'series';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Serie documental')
                    ->schema([
                        Select::make('section_id')
                            ->relationship('section', 'name')
                            ->label('Sección')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('subsection_id')
                            ->relationship('subsection', 'name')
                            ->label('Subsección')
                            ->searchable()
                            ->preload(),
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
                TextEntry::make('section.name')->label('Sección'),
                TextEntry::make('subsection.name')->label('Subsección'),
                TextEntry::make('code')->label('Código'),
                TextEntry::make('name')->label('Nombre'),
                TextEntry::make('description')->label('Descripción'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('section.name')
                    ->label('Sección')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subsection.name')
                    ->label('Subsección')
                    ->searchable(),
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
            'index' => ListArchivalSeries::route('/'),
            'create' => CreateArchivalSeries::route('/create'),
            'view' => ViewArchivalSeries::route('/{record}'),
            'edit' => EditArchivalSeries::route('/{record}/edit'),
        ];
    }
}
