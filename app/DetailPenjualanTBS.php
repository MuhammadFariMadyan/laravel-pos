<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualanTBS extends Model
{
    protected $table = 'tbs_penjualan_details';
    protected $fillable = [
        'kode_penjualan', 'id_barang','harga_jual_akhir', 'jumlah_jual', 'sub_total_harga', 'createdby', 'updatedby'
    ];
}
