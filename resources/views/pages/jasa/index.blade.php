@extends('layouts.template')
@section('page', 'Input Transaksi Jasa')
@section('content')
<input type="hidden" name="kode" id="kode" value="{{ $kode }}">
    <div class="row">
        <form action="{{ route('jasa.store') }}" method="POST">
            @csrf
            <div class="col-md-3">
                <div class="box box-danger">
                    <div class=" box-body">

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Transaksi</label>
                                    <input type="text" name="tangal" class="form-control" id="tangal" readonly
                                        style="cursor:no-drop" value="{{ date('Y-m-d H:i:s') }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="kasir">Nama Kasir</label>
                                    <input type="text" name="kasir" class="form-control" id="kasir" readonly
                                        style="cursor:no-drop" value="{{ Auth::user()->nama }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="box box-danger">
                    <div class=" box-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama_konsumen">Nama Konsumen</label>
                                <input type="text" class="form-control" name="nama_konsumen" id="nama_konsumen">
                            </div>

                            <div class="col-md-12">
                                <div class="form-group @error('kategori') has-error @enderror">
                                    <label for="kategori">Metode Jasa</label>
                                    <select name="kategori" id="kategori" class="form-control select">
                                        <option value="" selected disabled>Pilih Metode Jasa</option>
                                        @foreach ($kategori as $rowKategori)
                                            <option value="{{ $rowKategori->id }}">{{ $rowKategori->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 kotak-jangkauan-biaya">
                                <div class="form-group kotak-jangkauan-biaya @error('biaya') has-error @enderror">
                                    <label for="biaya">Jangkauan Biaya</label>
                                    <select value="" name="biaya" id="biaya"
                                        class="form-control @error('biaya') is-invalid @enderror">
                                        <option>{{ trans('Pilih Jangkauan Biaya') }}</option>
                                        {{-- @foreach ($kategori as $rowKategori)
                                        <option value="{{ $rowKategori->id }}">{{ $rowKategori->nama }}</option>
                                    @endforeach --}}
                                    </select>
                                    @error('biaya')
                                        <span class="help-block error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        {{-- <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="harga">Admin</label>
                                <input value="" type="text" name="harga" id="harga" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="harga">Keuntungan</label>
                                <input value="" type="text" name="harga" id="harga" class="form-control" readonly>
                            </div>
                        </div>
                    </div> --}}

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <span id="biaya_admin"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <span id="keuntungan"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="bayar">Nominal</label>
                                <input type="number" class="form-control" name="bayar" id="bayar">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" style="cursor:pointer"><i class="fa fa-location-arrow"></i>
                                    Proses Transaksi</button>
                                    @include('sweetalert::alert')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-danger">
                    <div class=" box-body">
                        <div align="right">
                            <h4>Invoice <b><span id="invoice">{{ $kode }}</span></b></h4>
                            <h1><b><span id="total" style="font-size:50pt;">0</span></b></h1>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="total">Masukan Ulang total Keselurahan</label>
                                    <input type="number" class="form-control" name="total" id="total">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/print/print.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/jquery-ui/jquery-ui.min.css">
@endpush

@push('script')
    <script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="{{ asset('adminlte') }}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/print/print.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#kategori').on('change', function() {
                var idKategori = this.value;
                $("#biaya").val();
                $.ajax({
                    url: "{{ route('jasa.getBiayaJasa') }}",
                    type: "POST",
                    data: {
                        kategori_jasa_id: idKategori,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#biaya').html(
                            '<option value="" selected disabled>Pilih Jangkauan Biaya</option>'
                        );
                        $.each(result.biaya_admin_jasa, function(key, value) {
                            $("#biaya").append('<option value="' + value
                                .id + '">' + value.biaya + '</option>');
                        });
                    }
                });
            });

            $(document).on('change', '#biaya', function(e) {
                var id = $(this).val();
                $.get("{{ route('jasa.listadmin') }}", {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id
                }, function(resp) {
                    $("#biaya_admin").html(resp);
                });
            });

            $(document).on('change', '#biaya', function(e) {
                var id = $(this).val();
                $.get("{{ route('jasa.listkeuntungan') }}", {
                    '_token': $('meta[name=csrf-token]').attr('content'),
                    id: id
                }, function(resp) {
                    $("#keuntungan").html(resp);
                });
            });


            $(document).ready(function() {
                $("#bayar, #badmin, #untung").keyup(function() {
                    var total = 0;
                    var bayar = $('#bayar').val();
                    var biaya_admin = $('#badmin').val();
                    var keuntungan = $('#untung').val();

                    if (bayar == '')
                        bayar = 0;
                    $total = parseFloat(bayar) + parseFloat(biaya_admin) + parseFloat(keuntungan);
                    //console.log(biaya_admin);
                    //console.log(keuntungan);
                    $('#total').text($total);

                });
            });
        });
    </script>
@endpush
