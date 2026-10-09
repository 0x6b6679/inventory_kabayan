<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required(),
                TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->required()
                    ->maxLength(20),
                TextInput::make('alamat')
                    ->label('Alamat')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                Select::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn($record) => $record === null) // required hanya saat create
                    ->dehydrated(fn($state) => filled($state)), // tidak update kalau kosong saat edit
            ])
            ->columns(1);
    }
}
