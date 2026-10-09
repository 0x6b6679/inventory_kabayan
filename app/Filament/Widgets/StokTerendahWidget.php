<?php

namespace App\Filament\Widgets;

use App\Models\StokGudang;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class StokTerendahWidget extends BaseWidget
{
    protected static ?string $heading = 'Barang dengan Stok Terendah';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                StokGudang::query()
                    ->with(['barang', 'gudang'])
                    ->orderBy('stok', 'asc')
                    ->limit(10)
            )
            ->columns([
                TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang')
                    ->searchable(),

                TextColumn::make('barang.sku')
                    ->label('SKU'),

                TextColumn::make('gudang.nama_gudang')
                    ->label('Gudang'),

                TextColumn::make('stok')
                    ->label('Stok')
                    ->badge()
                    ->color(fn(int $state) => match(true) {
                        $state <= 0  => 'danger',
                        $state <= 10 => 'warning',
                        default      => 'success',
                    }),
            ]);
    }
}
