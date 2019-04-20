<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelianTBS extends Model
{
    protected $table = 'tbs_pembelian_details';
    protected $fillable = [
        'kode_pembelian', 'id_barang', 'jumlah_beli', 'sub_total_harga', 'createdby', 'updatedby'
    ];
}
