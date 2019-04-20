<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returpembelian extends Model
{
    //
    protected $fillable = [
        'no_retur', 'tanggal', 'nama_supplier', 'kode_barang', 'nama_barang', 'jumlah', 'keterangan'
    ];

    protected $table = 'returpembelian';
}
