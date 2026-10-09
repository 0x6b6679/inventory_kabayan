<?php

namespace App\Filament\Resources\Barangs\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->required(),
                Select::make('id_kategori')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori')
                    ->required(),
                TextInput::make('satuan')
                    ->label('Satuan')
                    ->required(),
                TextInput::make('harga_pokok')
                    ->label('Harga Pokok')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                TextInput::make('harga_jual')
                    ->label('Harga Jual')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Select::make('id_status')
                    ->label('Status')
                    ->relationship('status', 'nama_status')
                    ->required(),
            ])
            ->columns(1);
    }
}
