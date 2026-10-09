<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'sku',
        'nama_barang',
        'id_kategori',
        'satuan',
        'harga_pokok',
        'harga_jual',
        'id_status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function stok()
    {
        return $this->hasMany(StokGudang::class, 'id_barang');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksiBarangMasuk::class, 'id_barang');
    }
}
