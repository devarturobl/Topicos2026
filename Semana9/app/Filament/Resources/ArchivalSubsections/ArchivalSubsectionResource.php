<?php

namespace App\Filament\Resources\ArchivalSubsections;

use App\Filament\Resources\ArchivalSubsections\Pages\CreateArchivalSubsection;
use App\Filament\Resources\ArchivalSubsections\Pages\EditArchivalSubsection;
use App\Filament\Resources\ArchivalSubsections\Pages\ListArchivalSubsections;
use App\Filament\Resources\ArchivalSubsections\Pages\ViewArchivalSubsection;
use App\Models\ArchivalSubsection;
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

class ArchivalSubsectionResource extends Resource
{
    protected static ?string $model = ArchivalSubsection::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Catálogos archivísticos';

    protected static ?string $modelLabel = 'subsección';

    protected static ?string $pluralModelLabel = 'subsecciones';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Subsección')
                    ->schema([
                        Select::make('section_id')
                            ->relationship('section', 'name')
                            ->label('Sección')
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
                TextEntry::make('section.name')->label('Sección'),
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
            'index' => ListArchivalSubsections::route('/'),
            'create' => CreateArchivalSubsection::route('/create'),
            'view' => ViewArchivalSubsection::route('/{record}'),
            'edit' => EditArchivalSubsection::route('/{record}/edit'),
        ];
    }
}
