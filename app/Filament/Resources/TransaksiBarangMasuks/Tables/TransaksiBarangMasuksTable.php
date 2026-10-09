<?php

namespace App\Filament\Resources\TransaksiBarangMasuks\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransaksiBarangMasuksTable
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

                TextColumn::make('user.name')
                    ->label('Dibuat Oleh')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state) => match($state) {
                        'aktif'      => 'success',
                        'dibatalkan' => 'danger',
                        default      => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->hidden(fn($record) => $record->status === 'dibatalkan'),

                Action::make('cancel')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Transaksi?')
                    ->modalDescription('Stok akan di-rollback. Tindakan ini tidak dapat diurungkan.')
                    ->hidden(fn($record) => $record->status === 'dibatalkan')
                    ->action(fn($record) => $record->cancel()),
            ])
            ->actionsColumnLabel('Aksi')
            ->toolbarActions([
                // Bulk delete sengaja dihapus — transaksi tidak boleh dihapus
            ]);
    }
}
