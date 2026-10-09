<?php

namespace App\Filament\Resources\TransaksiBarangMasuks\Pages;

use App\Filament\Resources\TransaksiBarangMasuks\TransaksiBarangMasukResource;
use Filament\Resources\Pages\EditRecord;

class EditTransaksiBarangMasuk extends EditRecord
{
    protected static string $resource = TransaksiBarangMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Delete tidak diizinkan — gunakan tombol Batalkan di halaman list
        ];
    }
}
