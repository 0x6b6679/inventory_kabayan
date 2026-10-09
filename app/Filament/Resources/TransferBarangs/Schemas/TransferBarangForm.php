<?php

namespace App\Filament\Resources\TransferBarangs\Schemas;

use App\Models\Barang;
use App\Models\Gudang;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransferBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_gudang_asal')
                    ->label('Gudang Asal')
                    ->options(Gudang::query()->pluck('nama_gudang', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('id_gudang_tujuan')
                    ->label('Gudang Tujuan')
                    ->options(Gudang::query()->pluck('nama_gudang', 'id'))
                    ->searchable()
                    ->required(),

                Textarea::make('keterangan')
                    ->label('Keterangan'),

                Repeater::make('detail')
                    ->label('Detail Barang yang Dipindahkan')
                    ->relationship()
                    ->schema([
                        Select::make('id_barang')
                            ->label('Barang')
                            ->options(Barang::query()->pluck('nama_barang', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('qty')
                            ->label('Jumlah')
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                    ])
                    ->columns(2)
                    ->minItems(1)
                    ->required(),
            ])
            ->columns(1);
    }
}
