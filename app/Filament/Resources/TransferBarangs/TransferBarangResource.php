<?php

namespace App\Filament\Resources\TransferBarangs;

use App\Filament\Resources\TransferBarangs\Pages\CreateTransferBarang;
use App\Filament\Resources\TransferBarangs\Pages\EditTransferBarang;
use App\Filament\Resources\TransferBarangs\Pages\ListTransferBarangs;
use App\Filament\Resources\TransferBarangs\Schemas\TransferBarangForm;
use App\Filament\Resources\TransferBarangs\Tables\TransferBarangsTable;
use App\Models\TransferBarang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransferBarangResource extends Resource
{
    protected static ?string $model = TransferBarang::class;

    protected static ?string $navigationLabel = 'Transfer Barang';
    protected static string|\UnitEnum|null $navigationGroup = 'Transaksi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    public static function form(Schema $schema): Schema
    {
        return TransferBarangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransferBarangsTable::configure($table);
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
            'index'  => ListTransferBarangs::route('/'),
            'create' => CreateTransferBarang::route('/create'),
            'edit'   => EditTransferBarang::route('/{record}/edit'),
        ];
    }
}
