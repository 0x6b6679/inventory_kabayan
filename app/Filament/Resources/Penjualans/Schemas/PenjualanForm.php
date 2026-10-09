<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use App\Models\Barang;
use App\Models\Gudang;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_gudang')
                    ->label('Gudang')
                    ->options(Gudang::query()->pluck('nama_gudang', 'id'))
                    ->searchable()
                    ->required(),

                TextInput::make('nama_pelanggan')
                    ->label('Nama Pelanggan')
                    ->placeholder('Isi nama pelanggan (opsional)')
                    ->maxLength(255),

                Textarea::make('keterangan')
                    ->label('Keterangan'),

                Repeater::make('detail')
                    ->label('Detail Barang')
                    ->relationship()
                    ->schema([
                        Select::make('id_barang')
                            ->label('Barang')
                            ->options(Barang::query()->pluck('nama_barang', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $harga = Barang::find($state)?->harga_jual ?? 0;
                                $set('harga_jual', $harga);
                            }),

                        TextInput::make('qty')
                            ->label('Jumlah')
                            ->numeric()
                            ->minValue(1)
                            ->required(),

                        TextInput::make('harga_jual')
                            ->label('Harga Jual')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                    ])
                    ->columns(3)
                    ->minItems(1)
                    ->required(),
            ])
            ->columns(1);
    }
}
