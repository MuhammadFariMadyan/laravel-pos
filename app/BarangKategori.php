<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangKategori extends Model
{
    protected $table = 'barang_kategori';
    protected $primaryKey = 'idbarang_kategori';
    protected $fillable = [
        'kategori'
    ];
}
