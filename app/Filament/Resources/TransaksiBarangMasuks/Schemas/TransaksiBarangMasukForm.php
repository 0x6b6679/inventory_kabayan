<?php

namespace App\Filament\Resources\TransaksiBarangMasuks\Schemas;

use App\Models\Barang;
use App\Models\Gudang;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransaksiBarangMasukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_gudang')
                    ->label('Gudang')
                    ->options(
                        Gudang::query()->pluck('nama_gudang', 'id')
                    )
                    ->searchable()
                    ->required(),

                Textarea::make('keterangan')
                    ->columnSpanFull(),

                Repeater::make('detail')
                    ->label('Detail Barang Masuk')
                    ->relationship()
                    ->schema([
                        Select::make('id_barang')
                            ->label('Barang')
                            ->options(
                                Barang::query()->pluck('nama_barang', 'id')
                            )
                            ->searchable()
                            ->required(),

                        TextInput::make('qty')
                            ->label('Jumlah')
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        TextInput::make('harga_pokok')
                            ->label('Harga Pokok')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                    ])
                    ->columns(3)
                    ->minItems(1)
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }
}
