<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransferBarang extends Model
{
    protected $fillable = [
        'id_transfer_barang',
        'id_barang',
        'qty',
    ];

    public function transferBarang()
    {
        return $this->belongsTo(TransferBarang::class, 'id_transfer_barang');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
