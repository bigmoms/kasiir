<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biaya_admin extends Model
{
    protected $table = 'biaya_admin_jasa';
    // public function barang()
    // {
    //     return $this->hasMany(Barang::class, 'kategori_id', 'id');
    // }

    Public function jasa()
    {
        return $this->hasMany(Transaksi_jasa::class, 'biaya_jasa_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_jasa::class, 'kategori_jasa_id', 'id');
    }
}
