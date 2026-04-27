<?php

namespace App\Filament\Resources\RetentionSchedules;

use App\Filament\Resources\RetentionSchedules\Pages\CreateRetentionSchedule;
use App\Filament\Resources\RetentionSchedules\Pages\EditRetentionSchedule;
use App\Filament\Resources\RetentionSchedules\Pages\ListRetentionSchedules;
use App\Filament\Resources\RetentionSchedules\Pages\ViewRetentionSchedule;
use App\Models\ArchivalSubseries;
use App\Models\RetentionSchedule;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class RetentionScheduleResource extends Resource
{
    protected static ?string $model = RetentionSchedule::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Catalogos archivisticos';

    protected static ?string $navigationLabel = 'Vigencias documentales';

    protected static ?string $modelLabel = 'vigencia documental';

    protected static ?string $pluralModelLabel = 'vigencias documentales';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Clasificacion documental')
                    ->schema([
                        Select::make('series_id')
                            ->relationship('series', 'name')
                            ->label('Serie')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set): void {
                                $set('subseries_id', null);
                            }),
                        Select::make('subseries_id')
                            ->label('Subserie')
                            ->options(fn (Get $get): array => self::getSubseriesOptions($get))
                            ->searchable()
                            ->preload()
                            ->helperText('Opcional. Si no se selecciona, la vigencia aplica a toda la serie.'),
                    ])
                    ->columns(2),
                Section::make('Vigencia y disposicion')
                    ->schema([
                        TextInput::make('tramite_years')
                            ->label('Anos en tramite')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        TextInput::make('concentracion_years')
                            ->label('Anos en concentracion')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        TextInput::make('final_disposition')
                            ->label('Disposicion final')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('legal_basis')
                            ->label('Fundamento legal')
                            ->columnSpanFull(),
                        Textarea::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Valores documentales')
                    ->schema([
                        Toggle::make('is_administrative')->label('Administrativo'),
                        Toggle::make('is_legal')->label('Legal'),
                        Toggle::make('is_fiscal_or_accounting')->label('Fiscal o contable'),
                        Toggle::make('is_evidential')->label('Evidencial'),
                        Toggle::make('is_testimonial')->label('Testimonial'),
                        Toggle::make('is_informative')->label('Informativo'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('series.name')->label('Serie'),
                TextEntry::make('subseries.name')->label('Subserie'),
                TextEntry::make('tramite_years')->label('Tramite'),
                TextEntry::make('concentracion_years')->label('Concentracion'),
                TextEntry::make('final_disposition')->label('Disposicion final'),
                IconEntry::make('is_administrative')->label('Administrativo')->boolean(),
                IconEntry::make('is_legal')->label('Legal')->boolean(),
                IconEntry::make('is_fiscal_or_accounting')->label('Fiscal o contable')->boolean(),
                IconEntry::make('is_evidential')->label('Evidencial')->boolean(),
                IconEntry::make('is_testimonial')->label('Testimonial')->boolean(),
                IconEntry::make('is_informative')->label('Informativo')->boolean(),
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
                TextColumn::make('subseries.name')
                    ->label('Subserie')
                    ->searchable(),
                TextColumn::make('tramite_years')->label('Tramite'),
                TextColumn::make('concentracion_years')->label('Concentracion'),
                TextColumn::make('final_disposition')
                    ->label('Disposicion final')
                    ->searchable(),
                IconColumn::make('is_administrative')->label('Adm.')->boolean(),
                IconColumn::make('is_evidential')->label('Evid.')->boolean(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRetentionSchedules::route('/'),
            'create' => CreateRetentionSchedule::route('/create'),
            'view' => ViewRetentionSchedule::route('/{record}'),
            'edit' => EditRetentionSchedule::route('/{record}/edit'),
        ];
    }

    protected static function getSubseriesOptions(Get $get): array
    {
        $seriesId = $get('series_id');

        if (blank($seriesId)) {
            return [];
        }

        return ArchivalSubseries::query()
            ->where('series_id', $seriesId)
            ->orderBy('code')
            ->get()
            ->mapWithKeys(fn (ArchivalSubseries $subseries): array => [
                $subseries->id => "{$subseries->code} - {$subseries->name}",
            ])
            ->all();
    }
}
