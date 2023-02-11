<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi_jasa extends Model
{
    protected $table = 'transaksi_jasa';
    public static function kode()
    {
        $cek = Transaksi_jasa::all();
        if ($cek->count() > 0) {
            $transaksi_jasa = Transaksi_jasa::orderBy('id', 'DESC')->first();
            $nourut = (int) substr($transaksi_jasa->kode, -8, 8);
            $nourut++;
            $char = "JSA";
            $number = $char  .  sprintf("%08s", $nourut);
        } else {
            $number = "JSA"  . "00000001";
        }
        return $number;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_jasa::class, 'kategori_jasa_id', 'id');

    }
    public function biaya()
    {
        return $this->belongsTo(Biaya_admin::class, 'biaya_jasa_id', 'id');
    }
}
