<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jasa extends Model
{
    use SoftDeletes;
    protected $table = 'jasa';
    public $incrementing = false;
    public static function kodeJasa()
    {
        $cek = Jasa::withTrashed()->get();
        if ($cek->count() > 0) {
            $peminjaman = Jasa::orderBy('id', 'DESC')->withTrashed()->first();
            $nourut = (int) substr($peminjaman->id, -7, 7);
            $nourut++;
            $char = "JSA";
            $number = $char  .  sprintf("%07s", $nourut);
        } else {
            $number = "JSA"  . "0000001";
        }
        return $number;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_jasa::class, 'kategori_jasa_id', 'id');
    }
    public function biaya()
    {
        return $this->belongsTo(Biaya_admin_jasa::class, 'biaya_jasa_id', 'id');
    }
    public function detail_transaksi()
    {
        return $this->hasMany(Detail_transaksi::class, 'barang_id', 'id');
    }
}
