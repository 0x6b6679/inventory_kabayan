<?php

namespace App\Filament\Resources\TransaksiBarangMasuks;

use App\Filament\Resources\TransaksiBarangMasuks\Pages\CreateTransaksiBarangMasuk;
use App\Filament\Resources\TransaksiBarangMasuks\Pages\EditTransaksiBarangMasuk;
use App\Filament\Resources\TransaksiBarangMasuks\Pages\ListTransaksiBarangMasuks;
use App\Filament\Resources\TransaksiBarangMasuks\Schemas\TransaksiBarangMasukForm;
use App\Filament\Resources\TransaksiBarangMasuks\Tables\TransaksiBarangMasuksTable;
use App\Models\TransaksiBarangMasuk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransaksiBarangMasukResource extends Resource
{
    protected static ?string $model = TransaksiBarangMasuk::class;

    protected static ?string $navigationLabel              = 'Barang Masuk';
    protected static string|\UnitEnum|null $navigationGroup = 'Transaksi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TransaksiBarangMasukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksiBarangMasuksTable::configure($table);
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
            'index' => ListTransaksiBarangMasuks::route('/'),
            'create' => CreateTransaksiBarangMasuk::route('/create'),
            'edit' => EditTransaksiBarangMasuk::route('/{record}/edit'),
        ];
    }
}
