@extends('layouts.template')
@section('page', 'Laporan Transaksi Jasa')
@section('content')
    <div class="row kotak-atas">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class=" box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Tanggal Awal</td>
                                        <td>
                                            <input type="text" class="form-control" id="startdate"
                                                placeholder="Tanggal awal" autocomplete="off" value="{{ date('Y-m-d') }}">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Tanggal Akhir</td>
                                        <td>
                                            <input type="text" class="form-control" id="enddate"
                                                placeholder="Tanggal akhir" autocomplete="off" value="{{ date('Y-m-d') }}">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <select id="kategori_jasa_id" class="form-control">
                                                <option value="all">Semua Transaksi</option>
                                                @foreach ($kategori as $rowKategori)
                                                    <option value="{{ $rowKategori->id }}">{{ $rowKategori->nama }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-success" id="filter-atas"><i class="fa fa-search"></i>
                                                Filter</button>
                                            <button class="btn btn-warning excel"><i class="fa fa-print"></i>
                                                Excel</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3>Nominal Transaksi</h3>
                                        </td>
                                        <td>
                                            <h3 id="sttlnominal">0</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Total admin</h3>
                                        </td>
                                        <td>
                                            <h3 id="sttladmin">0</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Total Keuntungan</h3>
                                        </td>
                                        <td>
                                            <h3 id="sttlkeuntungan">0</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3>Total Keselurahan</h3>
                                        </td>
                                        <td>
                                            <h3 id="sttlpnj">0</h3>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-default btn-sm lanjut" data-filter="hari"> Hari Ini</a>
                            <a href="#" class="btn btn-default btn-sm lanjut" data-filter="bulan"> Bulan Ini</a>
                            <a href="#" class="btn btn-default btn-sm lanjut" data-filter="tahun"> Tahun Ini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class=" box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">@yield('page')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::get('status'))
                                <div class="alert alert-{{ Session::get('status') }}">
                                    {{ Session::get('message') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                @include('pages.report.jasa.table')
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
    <link rel="stylesheet"
        href="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/print/print.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.css">
@endpush
@push('script')
    <script src="{{ asset('adminlte') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/print/print.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sttlpnj').html($('#ttlpnj').html());
            $('#sttladmin').html($('#ttladmin').html());
            $('#sttlkeuntungan').html($('#ttlkeuntungan').html());
            $('#sttlnominal').html($('#ttlnominal').html());
            $('#filter-atas').click(function() {
                if ($('#startdate').val() != "") {
                    tanggal_awal = $('#startdate').val();
                } else {
                    tanggal_awal = "all";
                }
                if ($('#enddate').val() != "") {
                    tanggal_akhir = $('#enddate').val();
                } else {
                    tanggal_akhir = "all";
                }
                loadTable($('#kategori_jasa_id').val(), tanggal_awal, tanggal_akhir);
            });
            $("#startdate").datepicker({
                todayBtn: 1,
                format: 'yyyy-mm-dd',
                autoclose: true,
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#enddate').datepicker('setStartDate', minDate);
            });
            $("#enddate").datepicker({
                format: 'yyyy-mm-dd'
            }).on('changeDate', function(selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#startdate').datepicker('setEndDate', maxDate);
            });

            $('.excel').click(function() {
                transaksi = $('#kategori_jasa_id').val();
                tanggal_awal = $('#startdate').val();
                tanggal_akhir = $('#enddate').val();
                let url =
                    `{{ url('report/jasa/excel?transaksi=${transaksi}&start=${tanggal_awal}&end=${tanggal_akhir}&lanjut=all') }}`;
                const parseResult = new DOMParser().parseFromString(url, "text/html");
                const parsedUrl = parseResult.documentElement.textContent;
                window.open(parsedUrl, '_blank');
            });

            function loadTable(transaksi = "all", tanggal_awal, tanggal_akhir, lanjut = "all") {
                let url =
                    `{{ url('report/jasa/loadTable?transaksi=${transaksi}&start=${tanggal_awal}&end=${tanggal_akhir}&lanjut=${lanjut}') }}`;
                const parseResult = new DOMParser().parseFromString(url, "text/html");
                const parsedUrl = parseResult.documentElement.textContent;
                $('.table-responsive').load(parsedUrl, function() {
                    loadKotakAtas();
                });
            }

            function loadKotakAtas() {
                $('#sttlpnj').html($('#ttlpnj').html());
                $('#sttladmin').html($('#ttladmin').html());
                $('#sttlkeuntungan').html($('#ttlkeuntungan').html());
                $('#sttlnominal').html($('#ttlnominal').html());
            }
            $(document).on('click', '.lanjut', function() {
                loadTable("asdasd", "asd", "asd", $(this).data('filter'));
            });
        });
    </script>
@endpush
