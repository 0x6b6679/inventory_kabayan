<?php

namespace App\Filament\Resources\StokGudangs;

use App\Filament\Resources\StokGudangs\Pages\CreateStokGudang;
use App\Filament\Resources\StokGudangs\Pages\EditStokGudang;
use App\Filament\Resources\StokGudangs\Pages\ListStokGudangs;
use App\Filament\Resources\StokGudangs\Schemas\StokGudangForm;
use App\Filament\Resources\StokGudangs\Tables\StokGudangsTable;
use App\Models\StokGudang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StokGudangResource extends Resource
{
    protected static ?string $model = StokGudang::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Gudang';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'stok';

    public static function form(Schema $schema): Schema
    {
        return StokGudangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StokGudangsTable::configure($table);
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
            'index' => ListStokGudangs::route('/'),
            'create' => CreateStokGudang::route('/create'),
            'edit' => EditStokGudang::route('/{record}/edit'),
        ];
    }
}
