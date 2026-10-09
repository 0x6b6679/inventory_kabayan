<?php

namespace App\Filament\Resources\Gudangs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GudangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_gudang')
                    ->label('Kode Gudang')
                    ->required(),
                TextInput::make('nama_gudang')
                    ->label('Nama Gudang')
                    ->required(),
                TextInput::make('lokasi')
                    ->label('Lokasi')
                    ->required(),
                Textarea::make('keterangan')
                    ->label('Keterangan'),
                Toggle::make('status')
                    ->label('Aktif')
                    ->default(true),
            ])
            ->columns(1);
    }
}
