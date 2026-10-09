<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Penjualan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected function getStats(): array
    {
        // Cek tabel sudah ada sebelum query
        if (!\Illuminate\Support\Facades\Schema::hasTable('penjualans')) {
            $totalPenjualanHariIni = 0;
        } else {
            $totalPenjualanHariIni = Penjualan::query()
                ->where('status', 'aktif')
                ->whereDate('tanggal', today())
                ->with('detail')
                ->get()
                ->sum(fn($p) => $p->detail->sum(fn($d) => $d->qty * $d->harga_jual));
        }

        $totalPelanggan = \Spatie\Permission\Models\Role::where('name', 'pelanggan')->exists()
            ? User::role('pelanggan')->count()
            : 0;

        return [
            Stat::make('Total Barang', Barang::count())
                ->icon('heroicon-o-archive-box')
                ->color('primary'),

            Stat::make('Total Gudang', Gudang::count())
                ->icon('heroicon-o-building-office-2')
                ->color('info'),

            Stat::make('Total Pelanggan', $totalPelanggan)
                ->icon('heroicon-o-users')
                ->color('warning'),

            Stat::make('Penjualan Hari Ini', 'Rp ' . number_format($totalPenjualanHariIni, 0, ',', '.'))
                ->icon('heroicon-o-banknotes')
                ->color('success'),
        ];
    }
}
