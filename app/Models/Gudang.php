<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $fillable = [
        'kode_gudang',
        'nama_gudang',
        'lokasi',
        'keterangan',
        'status',
    ];

    public function stokGudang()
    {
        return $this->hasMany(StokGudang::class);
    }

    public function transaksiBarangMasuk()
    {
        return $this->hasMany(TransaksiBarangMasuk::class, 'id_gudang');
    }

    public function transferAsal()
    {
        return $this->hasMany(TransferBarang::class, 'id_gudang_asal');
    }

    public function transferTujuan()
    {
        return $this->hasMany(TransferBarang::class, 'id_gudang_tujuan');
    }
}
