<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    //

    protected $fillable = [
        'kode_pembelian', 'id_supplier', 'tanggal', 'total_harga_beli', 'total_bayar', 'total_kembalian', 'tipe_pembayaran', 'status', 'createdby', 'updatedby'
    ];

    protected $table = 'pembelians';

    
    
}
