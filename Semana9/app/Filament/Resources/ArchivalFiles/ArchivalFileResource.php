<?php

namespace App\Filament\Resources\ArchivalFiles;

use App\Filament\Resources\ArchivalFiles\Pages\CreateArchivalFile;
use App\Filament\Resources\ArchivalFiles\Pages\EditArchivalFile;
use App\Filament\Resources\ArchivalFiles\Pages\ListArchivalFiles;
use App\Filament\Resources\ArchivalFiles\Pages\ViewArchivalFile;
use App\Models\AdministrativeUnit;
use App\Models\ArchivalFile;
use App\Models\ArchivalSection;
use App\Models\ArchivalSeries;
use App\Models\ArchivalSubsection;
use App\Models\ArchivalSubseries;
use App\Models\RetentionSchedule;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
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

class ArchivalFileResource extends Resource
{
    protected static ?string $model = ArchivalFile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Gestion documental';

    protected static ?string $navigationLabel = 'Expedientes';

    protected static ?string $modelLabel = 'expediente';

    protected static ?string $pluralModelLabel = 'expedientes';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identificacion archivistica')
                    ->schema([
                        Select::make('institution_id')
                            ->relationship('institution', 'name')
                            ->label('Institucion')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required()
                            ->afterStateUpdated(function (Set $set): void {
                                $set('administrative_unit_id', null);
                            }),
                        Select::make('administrative_unit_id')
                            ->label('Unidad administrativa')
                            ->options(fn (Get $get): array => self::getAdministrativeUnitOptions($get))
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('section_id')
                            ->label('Seccion')
                            ->options(fn (): array => self::getSectionOptions())
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set): void {
                                $set('subsection_id', null);
                                $set('series_id', null);
                                $set('subseries_id', null);
                            }),
                        Select::make('subsection_id')
                            ->label('Subseccion')
                            ->options(fn (Get $get): array => self::getSubsectionOptions($get))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set): void {
                                $set('series_id', null);
                                $set('subseries_id', null);
                            }),
                        Select::make('series_id')
                            ->label('Serie')
                            ->options(fn (Get $get): array => self::getSeriesOptions($get))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                $set('subseries_id', null);
                                self::syncRetentionSchedule($get, $set);
                            }),
                        Select::make('subseries_id')
                            ->label('Subserie')
                            ->options(fn (Get $get): array => self::getSubseriesOptions($get))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set): void {
                                self::syncRetentionSchedule($get, $set);
                            }),
                        TextInput::make('file_code')
                            ->label('Codigo de expediente')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
                Section::make('Descripcion del expediente')
                    ->schema([
                        TextInput::make('title')
                            ->label('Asunto')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Descripcion')
                            ->columnSpanFull(),
                        DatePicker::make('opened_at')->label('Fecha de apertura'),
                        DatePicker::make('closed_at')->label('Fecha de cierre'),
                        Select::make('document_tradition')
                            ->label('Tradicion documental')
                            ->options([
                                'original' => 'Original',
                                'copia' => 'Copia',
                            ])
                            ->default('original')
                            ->required(),
                        Select::make('document_support')
                            ->label('Soporte documental')
                            ->options([
                                'papel' => 'Papel / fisico',
                                'electronico' => 'Electronico',
                            ])
                            ->default('papel')
                            ->required(),
                        TextInput::make('page_count')
                            ->label('No. de fojas')
                            ->numeric(),
                        TextInput::make('legajo_total')
                            ->label('Total de legajos')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        TextInput::make('legajo_index')
                            ->label('Legajo actual')
                            ->numeric()
                            ->default(1)
                            ->required(),
                    ])
                    ->columns(3),
                Section::make('Ciclo de vida')
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'abierto' => 'Abierto',
                                'cerrado' => 'Cerrado',
                                'en_tramite' => 'En tramite',
                                'en_concentracion' => 'En concentracion',
                                'historico' => 'Historico',
                                'baja_autorizada' => 'Baja autorizada',
                                'baja_ejecutada' => 'Baja ejecutada',
                            ])
                            ->default('abierto')
                            ->required(),
                        Select::make('current_phase')
                            ->label('Fase archivistica')
                            ->options([
                                'tramite' => 'Tramite',
                                'concentracion' => 'Concentracion',
                                'historico' => 'Historico',
                            ])
                            ->default('tramite')
                            ->required(),
                        Toggle::make('contains_reserved_info')
                            ->label('Contiene informacion reservada'),
                        Toggle::make('contains_confidential_info')
                            ->label('Contiene informacion confidencial'),
                    ])
                    ->columns(2),
                Section::make('Valor documental y vigencia')
                    ->description('Se autocompleta al seleccionar una serie o subserie con vigencia registrada.')
                    ->relationship('classification')
                    ->schema([
                        Toggle::make('is_administrative')->label('Administrativo'),
                        Toggle::make('is_legal')->label('Legal'),
                        Toggle::make('is_fiscal_or_accounting')->label('Fiscal o contable'),
                        Toggle::make('is_evidential')->label('Evidencial'),
                        Toggle::make('is_testimonial')->label('Testimonial'),
                        Toggle::make('is_informative')->label('Informativo'),
                        TextInput::make('tramite_years')
                            ->label('Anos en tramite')
                            ->numeric()
                            ->default(0),
                        TextInput::make('concentracion_years')
                            ->label('Anos en concentracion')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(4),
                Section::make('Caracter de la informacion')
                    ->relationship('accessControl')
                    ->schema([
                        DatePicker::make('classification_date')
                            ->label('Fecha de clasificacion'),
                        TextInput::make('classified_by_area')
                            ->label('Area que clasifica')
                            ->maxLength(255),
                        Textarea::make('reserved_sections')
                            ->label('Informacion reservada')
                            ->columnSpanFull(),
                        TextInput::make('reservation_period')
                            ->label('Periodo de reserva')
                            ->maxLength(255),
                        Textarea::make('reservation_legal_basis')
                            ->label('Fundamento legal de reserva')
                            ->columnSpanFull(),
                        TextInput::make('reservation_extension')
                            ->label('Ampliacion de reserva')
                            ->maxLength(255),
                        Textarea::make('confidential_sections')
                            ->label('Informacion confidencial')
                            ->columnSpanFull(),
                        Textarea::make('confidential_legal_basis')
                            ->label('Fundamento legal de confidencialidad')
                            ->columnSpanFull(),
                        DatePicker::make('declassified_at')
                            ->label('Fecha de desclasificacion'),
                        Textarea::make('declassification_notes')
                            ->label('Notas de desclasificacion')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('file_code')->label('Codigo'),
                TextEntry::make('title')->label('Asunto'),
                TextEntry::make('institution.name')->label('Institucion'),
                TextEntry::make('administrativeUnit.name')->label('Unidad'),
                TextEntry::make('section.name')->label('Seccion'),
                TextEntry::make('subsection.name')->label('Subseccion'),
                TextEntry::make('series.name')->label('Serie'),
                TextEntry::make('subseries.name')->label('Subserie'),
                TextEntry::make('status')->label('Estado'),
                TextEntry::make('current_phase')->label('Fase'),
                TextEntry::make('opened_at')->label('Apertura')->date(),
                TextEntry::make('closed_at')->label('Cierre')->date(),
                IconEntry::make('contains_reserved_info')->label('Reservada')->boolean(),
                IconEntry::make('contains_confidential_info')->label('Confidencial')->boolean(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_code')
                    ->label('Codigo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Asunto')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('administrativeUnit.name')
                    ->label('Unidad')
                    ->searchable(),
                TextColumn::make('series.name')
                    ->label('Serie')
                    ->searchable(),
                TextColumn::make('subseries.name')
                    ->label('Subserie')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge(),
                TextColumn::make('current_phase')
                    ->label('Fase')
                    ->badge(),
                IconColumn::make('contains_confidential_info')
                    ->label('Confidencial')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArchivalFiles::route('/'),
            'create' => CreateArchivalFile::route('/create'),
            'view' => ViewArchivalFile::route('/{record}'),
            'edit' => EditArchivalFile::route('/{record}/edit'),
        ];
    }

    protected static function getAdministrativeUnitOptions(Get $get): array
    {
        $institutionId = $get('institution_id');

        if (blank($institutionId)) {
            return [];
        }

        return AdministrativeUnit::query()
            ->where('institution_id', $institutionId)
            ->orderBy('name')
            ->pluck('name', 'id')
            ->all();
    }

    protected static function getSectionOptions(): array
    {
        return ArchivalSection::query()
            ->orderBy('code')
            ->get()
            ->mapWithKeys(fn (ArchivalSection $section): array => [
                $section->id => "{$section->code} - {$section->name}",
            ])
            ->all();
    }

    protected static function getSubsectionOptions(Get $get): array
    {
        $sectionId = $get('section_id');

        if (blank($sectionId)) {
            return [];
        }

        return ArchivalSubsection::query()
            ->where('section_id', $sectionId)
            ->orderBy('code')
            ->get()
            ->mapWithKeys(fn (ArchivalSubsection $subsection): array => [
                $subsection->id => "{$subsection->code} - {$subsection->name}",
            ])
            ->all();
    }

    protected static function getSeriesOptions(Get $get): array
    {
        $sectionId = $get('section_id');

        if (blank($sectionId)) {
            return [];
        }

        return ArchivalSeries::query()
            ->where('section_id', $sectionId)
            ->when(filled($get('subsection_id')), fn ($query) => $query->where('subsection_id', $get('subsection_id')))
            ->orderBy('code')
            ->get()
            ->mapWithKeys(fn (ArchivalSeries $series): array => [
                $series->id => "{$series->code} - {$series->name}",
            ])
            ->all();
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

    protected static function syncRetentionSchedule(Get $get, Set $set): void
    {
        $schedule = self::resolveRetentionSchedule($get);

        if (! $schedule) {
            return;
        }

        $set('classification.tramite_years', $schedule->tramite_years);
        $set('classification.concentracion_years', $schedule->concentracion_years);
        $set('classification.is_administrative', $schedule->is_administrative);
        $set('classification.is_legal', $schedule->is_legal);
        $set('classification.is_fiscal_or_accounting', $schedule->is_fiscal_or_accounting);
        $set('classification.is_evidential', $schedule->is_evidential);
        $set('classification.is_testimonial', $schedule->is_testimonial);
        $set('classification.is_informative', $schedule->is_informative);
    }

    protected static function resolveRetentionSchedule(Get $get): ?RetentionSchedule
    {
        $subseriesId = $get('subseries_id');

        if (filled($subseriesId)) {
            $schedule = RetentionSchedule::query()
                ->where('subseries_id', $subseriesId)
                ->first();

            if ($schedule) {
                return $schedule;
            }
        }

        $seriesId = $get('series_id');

        if (blank($seriesId)) {
            return null;
        }

        return RetentionSchedule::query()
            ->where('series_id', $seriesId)
            ->whereNull('subseries_id')
            ->first();
    }
}
