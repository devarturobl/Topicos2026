<?php

namespace App\Filament\Resources\AdministrativeUnits;

use App\Filament\Resources\AdministrativeUnits\Pages\CreateAdministrativeUnit;
use App\Filament\Resources\AdministrativeUnits\Pages\EditAdministrativeUnit;
use App\Filament\Resources\AdministrativeUnits\Pages\ListAdministrativeUnits;
use App\Filament\Resources\AdministrativeUnits\Pages\ViewAdministrativeUnit;
use App\Models\AdministrativeUnit;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AdministrativeUnitResource extends Resource
{
    protected static ?string $model = AdministrativeUnit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Catálogos archivísticos';

    protected static ?string $modelLabel = 'unidad administrativa';

    protected static ?string $pluralModelLabel = 'unidades administrativas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Unidad administrativa')
                    ->schema([
                        Select::make('institution_id')
                            ->relationship('institution', 'name')
                            ->label('Institución')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('parent_id')
                            ->relationship('parent', 'name')
                            ->label('Unidad padre')
                            ->searchable()
                            ->preload(),
                        TextInput::make('code')
                            ->label('Clave')
                            ->maxLength(50),
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('responsible_name')
                            ->label('Responsable')
                            ->maxLength(255),
                        Toggle::make('is_active')
                            ->label('Activa')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('institution.name')->label('Institución'),
                TextEntry::make('parent.name')->label('Unidad padre'),
                TextEntry::make('code')->label('Clave'),
                TextEntry::make('name')->label('Nombre'),
                TextEntry::make('responsible_name')->label('Responsable'),
                IconEntry::make('is_active')->label('Activa')->boolean(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('institution.name')
                    ->label('Institución')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Clave')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('responsible_name')
                    ->label('Responsable')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Activa')
                    ->boolean(),
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
            'index' => ListAdministrativeUnits::route('/'),
            'create' => CreateAdministrativeUnit::route('/create'),
            'view' => ViewAdministrativeUnit::route('/{record}'),
            'edit' => EditAdministrativeUnit::route('/{record}/edit'),
        ];
    }
}
