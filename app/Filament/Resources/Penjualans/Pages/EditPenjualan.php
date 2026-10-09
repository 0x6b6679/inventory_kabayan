<?php

namespace App\Filament\Resources\Penjualans\Pages;

use App\Filament\Resources\Penjualans\PenjualanResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPenjualan extends EditRecord
{
    protected static string $resource = PenjualanResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        // Blokir edit penjualan yang sudah dibuat — stok sudah diproses
        Notification::make()
            ->title('Penjualan tidak dapat diedit')
            ->body('Stok sudah diproses saat penjualan dibuat. Gunakan tombol Batalkan jika ingin membatalkan transaksi.')
            ->warning()
            ->persistent()
            ->send();

        $this->redirect(PenjualanResource::getUrl('index'));
    }

    protected function getHeaderActions(): array
    {
        return [
            // Delete tidak diizinkan — gunakan tombol Batalkan di halaman list
        ];
    }
}
