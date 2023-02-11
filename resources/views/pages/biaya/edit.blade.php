@extends('layouts.template')
@section('page', 'Edit Biaya Jasa')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class=" box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">@yield('page')</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('biaya.update',$biaya->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group @error('kategori') has-error @enderror">
                                    <label for="kategori">Kategori Jasa</label>
                                    <select name="kategori" id="kategori"
                                        class="form-control @error('kategori') is-invalid @enderror">
                                        <option disabled selected>Pilih Kategori Jasa</option>
                                        @foreach ($kategori as $rowKategori)
                                        <option value="{{ $rowKategori->id }}"
                                            {{ $biaya->kategori_jasa_id == $rowKategori->id ? 'selected':'' }}>
                                            {{ $rowKategori->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group @error('biaya') has-error @enderror">
                                    <label for="biaya">Nominal</label>
                                    <input type="text" class="form-control " name="biaya" id="biaya"
                                        placeholder="Input Biaya" value="{{ $biaya->biaya }}">
                                    @error('biaya')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group @error('admin') has-error @enderror">
                                    <label for="admin">Biaya Admin</label>
                                    <input type="text" class="form-control " name="admin" id="biaya"
                                        placeholder="Input Admin" value="{{ $biaya->admin }}">
                                    @error('admin')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group @error('keuntungan') has-error @enderror">
                                    <label for="keuntungan">Keuntungan</label>
                                    <input type="text" class="form-control " name="keuntungan" id="keuntungan"
                                        placeholder="Input Keuntungan" value="{{ $biaya->keuntungan }}">
                                    @error('keuntungan')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-save"></i> Ubah</button>
                        <a href="{{ route('biaya.index') }}" class="btn btn-warning"><i class="fa fa-backward"></i>
                            Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
