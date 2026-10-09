<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiBarangMasuk extends Model
{
    protected $fillable = [
        'id_barang_masuk',
        'id_barang',
        'qty',
        'harga_pokok',
    ];

    public function transaksiBarangMasuk()
    {
        return $this->belongsTo(TransaksiBarangMasuk::class, 'id_barang_masuk');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
