<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pembelian;

class DetailPembelian extends Model
{
    protected $table = 'pembelian_details';
    protected $fillable = [ 						
        'id_pembelian', 'id_barang', 'tanggal', 'jumlah_beli', 'sub_total_harga', 'status', 'createdby', 'updatedby'
    ];    
}
