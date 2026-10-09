<?php

namespace App\Filament\Resources\Penjualans\Pages;

use App\Filament\Resources\Penjualans\PenjualanResource;
use App\Models\StokGudang;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;

    protected function afterCreate(): void
    {
        $penjualan = $this->record;
        $penjualan->load('detail');

        foreach ($penjualan->detail as $detail) {
            $stok = StokGudang::where('id_barang', $detail->id_barang)
                ->where('id_gudang', $penjualan->id_gudang)
                ->first();

            if (!$stok || $stok->stok < $detail->qty) {
                // Rollback: batalkan penjualan
                $penjualan->cancel();

                Notification::make()
                    ->title('Stok tidak mencukupi')
                    ->body("Stok barang tidak cukup untuk memenuhi permintaan.")
                    ->danger()
                    ->persistent()
                    ->send();

                $this->redirect(PenjualanResource::getUrl('index'));
                return;
            }

            $stok->decrement('stok', $detail->qty);
        }
    }
}
