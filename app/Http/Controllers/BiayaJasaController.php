<?php

namespace App\Http\Controllers;

use App\Biaya_admin;
use App\Kategori_jasa;
use Illuminate\Http\Request;

class BiayaJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $biaya = Biaya_admin::with('kategori','jasa')->get();
        return view("pages.biaya.index", compact('biaya'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori_jasa::get();
        return view("pages.biaya.create", compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'biaya' => 'required',
            'admin' => 'required|numeric',
            'keuntungan' => 'required|numeric'
        ]);
        $biaya = new Biaya_admin();
        $biaya->kategori_jasa_id = $request->kategori;
        $biaya->biaya = $request->biaya;
        $biaya->admin = $request->admin;
        $biaya->keuntungan = $request->keuntungan;
        if ($biaya->save()) {
            session()->flash('message', 'Data berhasil disimpan!');
            return redirect()->route('biaya.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan!');
            return redirect()->route('biaya.index')->with('status', 'danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Biaya_admin::findOrFail($id);
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori_jasa::get();
        $biaya = Biaya_admin::with('kategori', 'jasa')->where('id', $id)->firstOrFail();
        return view("pages.biaya.edit", compact('kategori', 'biaya'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required',
            'biaya' => 'required',
            'admin' => 'required|numeric',
            'keuntungan' => 'required|numeric'
        ]);
        $biaya = Biaya_admin::findOrFail($request->id);
        $biaya->kategori_jasa_id = $request->kategori;
        $biaya->biaya = $request->biaya;
        $biaya->admin = $request->admin;
        $biaya->keuntungan = $request->keuntungan;
        if ($biaya->save()) {
            session()->flash('message', 'Data berhasil diubah!');
            return redirect()->route('biaya.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal diubah!');
            return redirect()->route('biaya.index')->with('status', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biaya = Biaya_admin::findOrFail($id);
        $relasi = Biaya_admin::with('jasa')->find($id);
        if (count($relasi->jasa) < 1) {
            if ($biaya->delete()) {
                session()->flash('message', 'Data berhasil dihapus!');
                return redirect()->route('biaya.index')->with('status', 'success');
            } else {
                session()->flash('message', 'Data gagal dihapus!');
                return redirect()->route('biaya.index')->with('status', 'danger');
            }
        } else {
            session()->flash('message', 'Data gagal dihapus!');
            return redirect()->route('biaya.index')->with('status', 'danger');
        }
    }
}
