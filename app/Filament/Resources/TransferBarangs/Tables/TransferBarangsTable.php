<?php

namespace App\Filament\Resources\TransferBarangs\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransferBarangsTable
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

                TextColumn::make('gudangAsal.nama_gudang')
                    ->label('Gudang Asal')
                    ->sortable(),

                TextColumn::make('gudangTujuan.nama_gudang')
                    ->label('Gudang Tujuan')
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
                ViewAction::make(),

                EditAction::make()
                    ->hidden(fn($record) => $record->status === 'dibatalkan'),

                Action::make('cancel')
                    ->label('Batalkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Batalkan Transfer?')
                    ->modalDescription('Stok akan dikembalikan ke posisi semula. Tindakan ini tidak dapat diurungkan.')
                    ->hidden(fn($record) => $record->status === 'dibatalkan')
                    ->action(fn($record) => $record->cancel()),
            ])
            ->actionsColumnLabel('Aksi')
            ->toolbarActions([
                // Bulk delete sengaja dihapus — transaksi tidak boleh dihapus
            ]);
    }
}
