<?php

namespace App\Filament\Resources\StokGudangs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokGudangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_barang')
                    ->required()
                    ->relationship('barang', 'nama_barang'),
                Select::make('id_gudang')
                    ->required()
                    ->relationship('gudang', 'nama_gudang'),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->default(0),
            ])
            ->columns(1);
    }
}
