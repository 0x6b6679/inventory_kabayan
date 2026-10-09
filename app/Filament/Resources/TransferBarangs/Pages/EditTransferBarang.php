<?php

namespace App\Filament\Resources\TransferBarangs\Pages;

use App\Filament\Resources\TransferBarangs\TransferBarangResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditTransferBarang extends EditRecord
{
    protected static string $resource = TransferBarangResource::class;

    public function mount(int | string $record): void
    {
        parent::mount($record);

        // Blokir edit transfer yang sudah dibuat — stok sudah diproses
        Notification::make()
            ->title('Transfer tidak dapat diedit')
            ->body('Stok sudah diproses saat transfer dibuat. Gunakan tombol Batalkan jika ingin membatalkan transaksi.')
            ->warning()
            ->persistent()
            ->send();

        $this->redirect(TransferBarangResource::getUrl('index'));
    }

    protected function getHeaderActions(): array
    {
        return [
            // Delete tidak diizinkan — gunakan tombol Batalkan di halaman list
        ];
    }
}
