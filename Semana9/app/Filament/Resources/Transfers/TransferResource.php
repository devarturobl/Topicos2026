<?php

namespace App\Filament\Resources\Transfers;

use App\Filament\Resources\Transfers\Pages\CreateTransfer;
use App\Filament\Resources\Transfers\Pages\EditTransfer;
use App\Filament\Resources\Transfers\Pages\ListTransfers;
use App\Filament\Resources\Transfers\Pages\ViewTransfer;
use App\Models\Transfer;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class TransferResource extends Resource
{
    protected static ?string $model = Transfer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Gestión documental';

    protected static ?string $modelLabel = 'transferencia';

    protected static ?string $pluralModelLabel = 'transferencias';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos de transferencia')
                    ->schema([
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'transferencia_primaria' => 'Transferencia primaria',
                                'transferencia_secundaria' => 'Transferencia secundaria',
                            ])
                            ->required(),
                        Select::make('origin_unit_id')
                            ->relationship('originUnit', 'name')
                            ->label('Unidad origen')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('destination_unit_id')
                            ->relationship('destinationUnit', 'name')
                            ->label('Unidad destino')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'borrador' => 'Borrador',
                                'aprobada' => 'Aprobada',
                                'ejecutada' => 'Ejecutada',
                            ])
                            ->default('borrador')
                            ->required(),
                        DatePicker::make('transfer_date')
                            ->label('Fecha de transferencia'),
                        Textarea::make('notes')
                            ->label('Notas')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Expedientes incluidos')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('archival_file_id')
                                    ->relationship('archivalFile', 'file_code')
                                    ->label('Expediente')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('type')->label('Tipo'),
                TextEntry::make('originUnit.name')->label('Origen'),
                TextEntry::make('destinationUnit.name')->label('Destino'),
                TextEntry::make('status')->label('Estado'),
                TextEntry::make('transfer_date')->label('Fecha')->date(),
                TextEntry::make('items_count')->label('Expedientes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),
                TextColumn::make('originUnit.name')
                    ->label('Origen')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('destinationUnit.name')
                    ->label('Destino')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge(),
                TextColumn::make('transfer_date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('items_count')
                    ->label('Expedientes')
                    ->counts('items'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('print')
                    ->label('Imprimir')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Transfer $record): string => route('transfers.print', $record))
                    ->openUrlInNewTab(),
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
            'index' => ListTransfers::route('/'),
            'create' => CreateTransfer::route('/create'),
            'view' => ViewTransfer::route('/{record}'),
            'edit' => EditTransfer::route('/{record}/edit'),
        ];
    }
}
