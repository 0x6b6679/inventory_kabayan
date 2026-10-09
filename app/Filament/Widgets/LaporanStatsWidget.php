<?php

namespace App\Filament\Widgets;

use App\Models\DetailTransaksiBarangMasuk;
use App\Models\Penjualan;
use App\Models\StokGudang;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Schema;

class LaporanStatsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static bool $isDiscovered = false;

    protected function getStats(): array
    {
        $hasPenjualan = Schema::hasTable('penjualans');
        $hasStok      = Schema::hasTable('stok_gudangs');
        $hasTbm       = Schema::hasTable('transaksi_barang_masuks');

        $penjualanHariIni  = 0;
        $penjualanBulanIni = 0;
        $totalTrxBulanIni  = 0;

        if ($hasPenjualan) {
            $hariIni = Penjualan::where('status', 'aktif')
                ->whereDate('tanggal', today())
                ->with('detail')
                ->get();
            $penjualanHariIni = $hariIni->sum(fn($p) => $p->detail->sum(fn($d) => $d->qty * $d->harga_jual));

            $bulanIni = Penjualan::where('status', 'aktif')
                ->whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->with('detail')
                ->get();
            $penjualanBulanIni = $bulanIni->sum(fn($p) => $p->detail->sum(fn($d) => $d->qty * $d->harga_jual));
            $totalTrxBulanIni  = $bulanIni->count();
        }

        $barangMasukBulanIni = 0;
        if ($hasTbm) {
            $barangMasukBulanIni = DetailTransaksiBarangMasuk::whereHas(
                'transaksiBarangMasuk',
                fn($q) => $q->where('status', 'aktif')
                    ->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
            )->sum('qty');
        }

        $stokKritis = $hasStok ? StokGudang::where('stok', '<=', 5)->count() : 0;
        $stokHabis  = $hasStok ? StokGudang::where('stok', '<=', 0)->count() : 0;

        return [
            Stat::make('Penjualan Hari Ini', 'Rp ' . number_format($penjualanHariIni, 0, ',', '.'))
                ->description('Transaksi aktif hari ini')
                ->icon('heroicon-o-banknotes')
                ->color('success'),

            Stat::make('Penjualan Bulan Ini', 'Rp ' . number_format($penjualanBulanIni, 0, ',', '.'))
                ->description($totalTrxBulanIni . ' transaksi ' . now()->format('M Y'))
                ->icon('heroicon-o-chart-bar')
                ->color('primary'),

            Stat::make('Barang Masuk Bulan Ini', number_format($barangMasukBulanIni, 0, ',', '.') . ' unit')
                ->description('Total qty masuk ' . now()->format('M Y'))
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info'),

            Stat::make('Stok Kritis (≤ 5)', $stokKritis . ' item')
                ->description($stokHabis . ' item stok habis')
                ->icon('heroicon-o-exclamation-triangle')
                ->color($stokKritis > 0 ? 'danger' : 'success'),
        ];
    }
}
