<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangPersediaan extends Model
{
    protected $fillable = [
        'id_barang', 'id_supplier', 'detail','tanggal_beli', 'tanggal_jual', 'stok_beli', 'stok_jual', 'createdby', 'updatedby'
    ];
    protected $table = 'barang_persediaans';
}
