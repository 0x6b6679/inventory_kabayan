<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransaksiBarangMasuk extends Model
{
    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'id_gudang',
        'id_user',
        'keterangan',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (TransaksiBarangMasuk $transaksi) {
            $urutan = static::count() + 1;

            $transaksi->no_transaksi = 'TBM-' . now()->format('Ymd') . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
            $transaksi->tanggal      = now()->toDateString();
            $transaksi->id_user      = Auth::id();
            $transaksi->status       = 'aktif';
        });

        // Blokir hard delete — transaksi hanya boleh dibatalkan
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
            StokGudang::where('id_barang', $detail->id_barang)
                ->where('id_gudang', $this->id_gudang)
                ->decrement('stok', $detail->qty);
        }

        $this->update(['status' => 'dibatalkan']);
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
        return $this->hasMany(DetailTransaksiBarangMasuk::class, 'id_barang_masuk');
    }
}
