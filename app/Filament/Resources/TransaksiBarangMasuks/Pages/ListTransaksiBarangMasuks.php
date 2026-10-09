<?php

namespace App\Filament\Resources\TransaksiBarangMasuks\Pages;

use App\Filament\Resources\TransaksiBarangMasuks\TransaksiBarangMasukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransaksiBarangMasuks extends ListRecords
{
    protected static string $resource = TransaksiBarangMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
