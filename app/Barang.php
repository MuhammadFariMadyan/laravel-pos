<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'harga_beli','harga_jual', 'idbarang_kategori', 'idbarang_unit', 'stok', 'diskon', 'harga_jual_akhir', 'createdby', 'updatedby'
    ];
    protected $table = 'barang';
}
