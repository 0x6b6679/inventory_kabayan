<?php

namespace App\Filament\Resources\TransaksiBarangMasuks\Pages;

use App\Filament\Resources\TransaksiBarangMasuks\TransaksiBarangMasukResource;
use App\Models\StokGudang;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaksiBarangMasuk extends CreateRecord
{
    protected static string $resource = TransaksiBarangMasukResource::class;

    // Dipanggil setelah record + semua repeater tersimpan
    protected function afterCreate(): void
    {
        $transaksi = $this->record;
        $transaksi->load('detail');

        foreach ($transaksi->detail as $detail) {
            // Tambah stok gudang
            StokGudang::firstOrCreate(
                [
                    'id_barang' => $detail->id_barang,
                    'id_gudang' => $transaksi->id_gudang,
                ],
                ['stok' => 0]
            )->increment('stok', $detail->qty);
        }
    }
}
