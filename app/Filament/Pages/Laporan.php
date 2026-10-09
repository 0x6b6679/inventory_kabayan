<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LaporanFilterWidget;
use App\Filament\Widgets\LaporanStatsWidget;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Laporan extends Page
{
    protected static ?string $navigationLabel               = 'Laporan';
    protected static string|\UnitEnum|null $navigationGroup = 'Laporan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentChartBar;

    protected string $view = 'filament.pages.laporan';

    public function getWidgets(): array
    {
        return [
            LaporanStatsWidget::class,
            LaporanFilterWidget::class,
        ];
    }
}
