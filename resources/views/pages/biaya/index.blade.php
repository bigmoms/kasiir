@extends('layouts.template')
@section('page','Biaya Jasa')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">@yield('page')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('status'))
                            <div class="alert alert-{{ Session::get('status') }}" role="alert">{{ Session::get('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                <a href=" {{ route('biaya.create') }}" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> Tambah
                    Data</a>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"
                                id="example-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kategori</th>
                                        <th>Biaya</th>
                                        <th>Admin</th>
                                        <th>Keuntungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($biaya as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->kategori->nama }}</td>
                                        <td> {{ $row->biaya }} </td>
                                        <td> @rupiah($row->admin) </td>
                                        <td> @rupiah($row->keuntungan) </td>

                                        <td>
                                            {{-- <a href="#" class="btn btn-info btn-sm tmb-stok" data-id="{{ $row->id }}">Tambah
                                            Stok</a> --}}
                                            <a href="{{ route('biaya.edit',$row->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="{{ route('biaya.destroy',$row->id) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@push('style')
<link rel="stylesheet"
    href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@push('script')
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<!-- SlimScroll -->

@endpush
