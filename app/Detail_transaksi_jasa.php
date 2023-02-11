<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_transaksi_jasa extends Model
{
    protected $table = 'detail_transaksi_jasa';
    public function transaksi_jasa()
    {
        return $this->belongsTo(Transaksi_jasa::class, 'transaksi_jasa_id', 'id');
    }
}
