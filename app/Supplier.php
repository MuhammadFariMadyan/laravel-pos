<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = [
        'kode_supplier', 'nama_supplier', 'alamat_supplier', 'keterangan', 'no_hp'
    ];

    protected $table = 'suppliers';
}
