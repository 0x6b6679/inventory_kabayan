<?php

namespace App\Filament\Resources\TransferBarangs\Pages;

use App\Filament\Resources\TransferBarangs\TransferBarangResource;
use App\Models\StokGudang;
use Filament\Resources\Pages\CreateRecord;

class CreateTransferBarang extends CreateRecord
{
    protected static string $resource = TransferBarangResource::class;

    // Dipanggil setelah record + semua repeater tersimpan
    protected function afterCreate(): void
    {
        $transfer = $this->record;
        $transfer->load('detail');

        foreach ($transfer->detail as $detail) {
            // Kurangi stok gudang asal
            StokGudang::where('id_barang', $detail->id_barang)
                ->where('id_gudang', $transfer->id_gudang_asal)
                ->decrement('stok', $detail->qty);

            // Tambah stok gudang tujuan (buat row baru jika belum ada)
            StokGudang::firstOrCreate(
                [
                    'id_barang' => $detail->id_barang,
                    'id_gudang' => $transfer->id_gudang_tujuan,
                ],
                ['stok' => 0]
            )->increment('stok', $detail->qty);
        }
    }
}
