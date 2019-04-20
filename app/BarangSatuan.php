<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangSatuan extends Model
{
    protected $table = 'barang_unit';
    protected $primaryKey = 'idbarang_unit';
    protected $fillable = [
        'unit'
    ];
}
