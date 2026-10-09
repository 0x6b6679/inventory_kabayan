<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TransferBarang extends Model
{
    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'id_gudang_asal',
        'id_gudang_tujuan',
        'id_user',
        'keterangan',
        'status',
    ];

    protected static function booted(): void
    {
        static::creating(function (TransferBarang $transfer) {
            $urutan = static::count() + 1;

            $transfer->no_transaksi = 'TRF-' . now()->format('Ymd') . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
            $transfer->tanggal      = now()->toDateString();
            $transfer->id_user      = Auth::id();
            $transfer->status       = 'aktif';
        });

        // Blokir hard delete
        static::deleting(function () {
            throw new \Exception('Transaksi tidak dapat dihapus. Gunakan fitur Batalkan Transaksi.');
        });
    }

    // Method cancel: balik stok ke posisi semula
    public function cancel(): void
    {
        if ($this->status === 'dibatalkan') {
            return;
        }

        foreach ($this->detail as $detail) {
            // Kembalikan stok ke gudang asal
            StokGudang::where('id_barang', $detail->id_barang)
                ->where('id_gudang', $this->id_gudang_asal)
                ->increment('stok', $detail->qty);

            // Kurangi stok dari gudang tujuan
            StokGudang::where('id_barang', $detail->id_barang)
                ->where('id_gudang', $this->id_gudang_tujuan)
                ->decrement('stok', $detail->qty);
        }

        $this->update(['status' => 'dibatalkan']);
    }

    public function gudangAsal()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang_asal');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang_tujuan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransferBarang::class, 'id_transfer_barang');
    }
}
