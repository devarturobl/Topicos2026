<?php

namespace App\Filament\Resources\ArchivalSections;

use App\Filament\Resources\ArchivalSections\Pages\CreateArchivalSection;
use App\Filament\Resources\ArchivalSections\Pages\EditArchivalSection;
use App\Filament\Resources\ArchivalSections\Pages\ListArchivalSections;
use App\Filament\Resources\ArchivalSections\Pages\ViewArchivalSection;
use App\Models\ArchivalSection;
use BackedEnum;
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

class ArchivalSectionResource extends Resource
{
    protected static ?string $model = ArchivalSection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Catálogos archivísticos';

    protected static ?string $modelLabel = 'sección';

    protected static ?string $pluralModelLabel = 'secciones';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Sección')
                    ->schema([
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
                TextEntry::make('code')->label('Código'),
                TextEntry::make('name')->label('Nombre'),
                TextEntry::make('description')->label('Descripción'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subsections_count')
                    ->label('Subsecciones')
                    ->counts('subsections'),
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
            'index' => ListArchivalSections::route('/'),
            'create' => CreateArchivalSection::route('/create'),
            'view' => ViewArchivalSection::route('/{record}'),
            'edit' => EditArchivalSection::route('/{record}/edit'),
        ];
    }
}
