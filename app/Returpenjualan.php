<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returpenjualan extends Model
{
    //
    protected $fillable = [
        'no_retur', 'tanggal', 'nama_penjaga', 'kode_barang', 'nama_barang', 'jumlah', 'keterangan'
    ];

    protected $table = 'returpenjualan';
}
