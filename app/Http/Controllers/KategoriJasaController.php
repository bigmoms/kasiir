<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori_jasa;

class KategoriJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kategori = Kategori_jasa::all();
        return view("pages.kategori_jasa.index", compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.kategori_jasa.create");
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
            'nama' => 'required|min:3'
        ]);
        $kategori = new Kategori_jasa();
        $kategori->nama = $request->nama;
        if ($kategori->save()) {
            session()->flash('message', 'Data berhasil disimpan!');
            return redirect()->route('kategorijasa.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan!');
            return redirect()->route('kategorijasa.index')->with('status', 'danger');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori_jasa::findOrFail($id);
        return view("pages.kategori_jasa.edit", compact('kategori'));
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
            'nama' => 'required|min:3'
        ]);
        $kategori = Kategori_jasa::find($id);
        $kategori->nama = $request->nama;
        if ($kategori->save()) {
            session()->flash('message', 'Data berhasil diubah!');
            return redirect()->route('kategorijasa.index')->with('status', 'success');
        } else {
            session()->flash('message', 'Data gagal diubah!');
            return redirect()->route('kategorijasa.index')->with('status', 'danger');
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
        $kategori = Kategori_jasa::findOrFail($id);
        $relasi = Kategori_jasa::with('jasa')->find($id);
        if (count($relasi->jasa) < 1) {
            if ($kategori->delete()) {
                session()->flash('message', 'Data berhasil dihapus!');
                return redirect()->route('kategorijasa.index')->with('status', 'success');
            } else {
                session()->flash('message', 'Data gagal dihapus!');
                return redirect()->route('kategorijasa.index')->with('status', 'danger');
            }
        } else {
            session()->flash('message', 'Data gagal dihapus!');
            return redirect()->route('pelanggan.index')->with('status', 'danger');
        }
    }
}
