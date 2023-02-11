@push('style')
<script src="{{ asset('adminlte') }}/bower_components/jquery/dist/jquery.min.js"></script>
@endpush
<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="example-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Faktur</th>
            <th>Konsumen</th>
            <th>Jenis</th>
            <th>Jangkauan Biaya</th>
            <th>Admin</th>
            <th>Keuntungan</th>
            <th>Nominal Transfer</th>

        </tr>
    </thead>
    <tbody>
        @php
        $ttladmin = 0;
        $ttlkeuntungan = 0;
        $ttlnominal = 0;
        $total = 0;
        @endphp
        @foreach ($transaksi as $key => $item)

        <tr>
            <td>{{$key++ }}</td>
            <td>{{ $item->tanggal_transaksi }}</td>
            <td>{{ $item->kode }}</td>
            <td>{{ $item->nama_konsumen }}</td>
            <td>{{ $item->kategori->nama }}</td>
            <td>{{ $item->biaya->biaya }}</td>
            <td> @rupiah($item->biaya_admin)</td>
            <td> @rupiah($item->keuntungan)</td>
            <td> @rupiah($item->nominal)</td>
        </tr>

        @php
        $total += $item->total;
        $ttladmin += $item->biaya_admin;
        $ttlkeuntungan += $item->keuntungan;
        $ttlnominal += $item->nominal;
        @endphp
        @endforeach
    </tbody>
    <thead>
        <tr>
            <td colspan="6">
                <center><b>Total</b></center>
            </td>
            <td><b id="ttladmin">@rupiah($ttladmin)</b></td>
            <td><b id="ttlkeuntungan">@rupiah($ttlkeuntungan)</b></td>
            <td><b id="ttlnominal">@rupiah($ttlnominal)</b></td>
        </tr>
        <tr>
            <td colspan="8">
                <center><b>Total Keselurahan</b></center>
            </td>
            <td><b id="ttlpnj">@rupiah($total)</b></td>

        </tr>
    </thead>
</table>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js">
</script>
<script>
    $(document).ready(function(){
        $('#example-table').dataTable();
    });
</script>
