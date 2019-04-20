<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    //
    protected $fillable = [
        'kode_kas', 'tanggal', 'keterangan','ref', 'debit', 'kredit', 'saldo', 'createdby', 'updatedby'
    ];
    				
    protected $table = 'kas';
}
