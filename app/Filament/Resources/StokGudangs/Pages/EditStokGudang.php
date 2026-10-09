<?php

namespace App\Filament\Resources\StokGudangs\Pages;

use App\Filament\Resources\StokGudangs\StokGudangResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStokGudang extends EditRecord
{
    protected static string $resource = StokGudangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
