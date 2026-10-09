<?php

namespace App\Filament\Resources\TransferBarangs\Pages;

use App\Filament\Resources\TransferBarangs\TransferBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransferBarangs extends ListRecords
{
    protected static string $resource = TransferBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
