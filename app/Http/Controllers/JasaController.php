<?php

namespace App\Http\Controllers;

use App\Detail_transaksi_jasa;
use App\Kategori_jasa;
use App\Biaya_admin;
use App\Transaksi_jasa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class JasaController extends Controller
{
    public function index()
    {
        $kode = Transaksi_jasa::kode();
        $kategori = Kategori_jasa::with('jasa', 'biaya')->get();

        return view("pages.jasa.index", compact('kode', 'kategori'));
    }

    public function getBiayaJasa(Request $request)
    {
        $biaya['biaya_admin_jasa'] = Biaya_admin::where("kategori_jasa_id", $request->kategori_jasa_id)
            ->get(["biaya", "admin", "keuntungan", "id"]);

        return response()->json($biaya);
    }


    // Filter List Harga
    public function listadmin(Request $request)
    {
        $list_admin = Biaya_admin::select('id', 'admin')
            ->where('id', $request->id)
            ->first();
        //dd($list_admin);
        $input = '';
        $input .= '
                     <div class="form-group">
                     <label for="biaya" class="control-label" readonly>Admin</label>
                     <input type="hidden" name="badmin" id="badmin" value="' . $list_admin->admin . '" class="form-control" readonly>
                     <input type="text" name="biaya_admin" id="biaya_admin" value="' . 'Rp. ' . number_format($list_admin->admin, 0, ",", ".") . '" class="form-control" readonly>
                     </input>
                     </div>
                     </div>';
        return $input;
    }

    public function listkeuntungan(Request $request)
    {
        $list_keuntungan = Biaya_admin::select('id', 'keuntungan')
            ->where('id', $request->id)
            ->first();
        //dd($list_admin);
        $input = '';
        $input .= '
                     <div class="form-group">
                     <label for="biaya" class="control-label" readonly>Keuntungan</label>
                     <input type="hidden" name="untung" id="untung" value="' . ($list_keuntungan->keuntungan) . '" class="form-control" readonly>
                     <input type="text" name="keuntungan" id="keuntungan" value="' . 'Rp. ' . number_format($list_keuntungan->keuntungan, 0, ",", ".") . '" class="form-control" readonly>
                     </input>
                     </div>
                     </div>';
        return $input;
    }


    // Filter List Harga
    // public function listkeuntungan(Request $request)
    // {
    //     $list_keuntungan = Biaya_admin::select('id', 'Keuntungan')
    //         ->where('id', $request->id)
    //         ->get();
    //     $select = '';
    //     $select .= '
    //                  <div class="form-group">
    //                  <label for="biaya" class="control-label" readonly>Keuntungan</label>
    //                  <select id="keuntungan" class="form-control" name="keuntungan" value="" readonly>
    //                  ';
    //     foreach ($list_keuntungan as $Keuntungan) {
    //         $select .= '<option value="' . $Keuntungan->Keuntungan . '">' . 'Rp. ' . number_format($Keuntungan->Keuntungan, 0, ",", ".") . '</option>';
    //     }
    //     '
    //                  </select>
    //                  </div>
    //                  </div>';
    //     return $select;
    // }



    public function store(Request $request)
    {


        $transaksi = new Transaksi_jasa();
        $transaksi->kode = Transaksi_jasa::kode();
        $transaksi->tanggal_transaksi = Carbon::now()->format('Y-m-d');
        $transaksi->nama_konsumen = $request->nama_konsumen;
        $transaksi->kategori_jasa_id = $request->kategori;
        $transaksi->biaya_jasa_id = $request->biaya;
        $transaksi->biaya_admin = $request->badmin;
        $transaksi->keuntungan = $request->untung;
        $transaksi->nominal = $request->bayar;
        $transaksi->total = $request->total;
        $transaksi->user_id = Auth::user()->id;
        $transaksi->save();

        if ($transaksi->save()) {
            Alert::success('Transaksi Berhasil!');
            return redirect()->route('jasa.index');
        } else {
            session()->flash('message', 'Transaksi Gagal!');
            return redirect()->route('jasa.index')->with('status', 'danger');
        }
    }
}
