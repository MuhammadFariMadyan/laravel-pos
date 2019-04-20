<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuPersediaan extends Model
{
    protected $fillable = [
        'id_barang', 'keterangan', 'no_transaksi','tanggal', 'masuk', 'keluar', 'sisa', 'created_at', 'updated_at', 'createdby'
    ]; 
    protected $table = 'kartu_persediaans';
}
