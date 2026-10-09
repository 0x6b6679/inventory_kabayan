<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Penjualan extends Model
{
    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'id_gudang',
        'id_user',
        'nama_pelanggan',
        'status',
        'keterangan',
    ];

    protected static function booted(): void
    {
        static::creating(function (Penjualan $penjualan) {
            $urutan = static::count() + 1;

            $penjualan->no_transaksi = 'PJL-' . now()->format('Ymd') . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
            $penjualan->tanggal      = now()->toDateString();
            $penjualan->id_user      = Auth::id();
            $penjualan->status       = 'aktif';
        });

        // Blokir hard delete
        static::deleting(function () {
            throw new \Exception('Transaksi tidak dapat dihapus. Gunakan fitur Batalkan Transaksi.');
        });
    }

    // Method cancel: rollback stok lalu ubah status
    public function cancel(): void
    {
        if ($this->status === 'dibatalkan') {
            return;
        }

        foreach ($this->detail as $detail) {
            // Kembalikan stok ke gudang
            StokGudang::where('id_barang', $detail->id_barang)
                ->where('id_gudang', $this->id_gudang)
                ->increment('stok', $detail->qty);
        }

        $this->update(['status' => 'dibatalkan']);
    }

    // Total nilai penjualan (qty * harga_jual snapshot)
    public function getTotalAttribute(): int
    {
        return $this->detail->sum(fn($d) => $d->qty * $d->harga_jual);
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
    }
}
