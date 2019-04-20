<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Penjualan;

class DetailPenjualan extends Model
{
    protected $table = 'penjualan_details';
    protected $fillable = [ 						
        'id_penjualan', 'id_barang', 'jumlah_jual', 'harga_jual_akhir', 'sub_total_harga', 'status', 'createdby', 'updatedby'
    ];
}
