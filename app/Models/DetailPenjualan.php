<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $fillable = [
        'id_penjualan',
        'id_barang',
        'qty',
        'harga_jual', // snapshot harga saat transaksi, tidak berubah walau master berubah
    ];

    // Subtotal untuk baris ini
    public function getSubtotalAttribute(): int
    {
        return $this->qty * $this->harga_jual;
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
