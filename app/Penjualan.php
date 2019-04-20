<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $fillable = [
        'kode_penjualan', 'pelanggan', 'tanggal', 'total_harga_jual', 'total_bayar', 'total_kembalian', 'tipe_pembayaran', 'status','createdby','updatedby'
    ];
    
    protected $table = 'penjualans';
    
}
