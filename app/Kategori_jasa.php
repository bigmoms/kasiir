<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori_jasa extends Model
{
    protected $table = 'kategori_jasa';
    // public function barang()
    // {
    //     return $this->hasMany(Barang::class, 'kategori_id', 'id');
    // }

    Public function jasa()
    {
        return $this->hasMany(Transaksi_jasa::class, 'kategori_jasa_id', 'id');
    }

    public function biaya()
    {
        return $this->hasMany(Biaya_admin::class, 'kategori_jasa_id', 'id');
    }
}
