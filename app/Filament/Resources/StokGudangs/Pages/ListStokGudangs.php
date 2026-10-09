<?php

namespace App\Filament\Resources\StokGudangs\Pages;

use App\Filament\Resources\StokGudangs\StokGudangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStokGudangs extends ListRecords
{
    protected static string $resource = StokGudangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
