<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_transaksi')
                    ->label('No. Transaksi')
                    ->searchable(),

                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),

                TextColumn::make('gudang.nama_gudang')
                    ->label('Gudang')
                    ->sortable(),

                TextColumn::make('nama_pelanggan')
                    ->label('Pelanggan')
                    ->default('-')
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Kasir')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'aktif'      => 'success',
                        'dibatalkan' => 'danger',
                        default      => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),

                Action::make('cancel')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Penjualan?')
                    ->modalDescription('Stok akan dikembalikan ke gudang. Tindakan ini tidak dapat diurungkan.')
                    ->hidden(fn($record) => $record->status === 'dibatalkan')
                    ->action(fn($record) => $record->cancel()),
            ])
            ->actionsColumnLabel('Aksi')
            ->toolbarActions([]);
    }
}
