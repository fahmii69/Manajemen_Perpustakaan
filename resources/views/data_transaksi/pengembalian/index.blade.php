@extends('layout.main')

@section('title','Data Pengembalian')

@section('content')
@include('sweetalert::alert')

<!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Pengembalian</span>
    </i>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-md-4">
                <label for="" class="row">Date Range</label>
                <input type="text" name="daterange" class="form-control row" value="" id="daterange" />
                <br>
                <button class="row btn btn-success btn-icon-split btn-export">
                    <input type="hidden" name="jenis" class="form-control row" value="Pengembalian" id="jenis" />
                    <span class="icon text-white-50">
                        <i class="fas fa-file"></i>
                    </span>
                    <span class="text" >Export Excel</span>
                </button>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="pengembalian-dataTable" width="100%" cellspacing="0">
                    <thead>
                            <th>No. Pinjam</th>
                            <th>Judul</th>
                            <th>Nama Siswa</th>
                            <th>Tgl. Pinjam</th>
                            <th>Tgl. Kembali</th>
                            <th>Tgl. Pengembalian</th>
                            <th>Denda Terlambat</th>
                            <th>Denda Kehilangan</th>
                            <th>Total Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('layout.script');
<script>
        $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            locale:{
                format: 'DD/MM/YYYY'
            }
        }, function(startDate, endDate, label) {
            console.log(startDate, endDate)
            console.log("A new date selection was made: " + startDate.format('YYYY-MM-DD') + ' to ' + endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').val(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').html(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format('YYYY-MM-DD'));
        });
    });

    $(document).on('click', '.btn-export', function(){
        let url = "{{ route('laporan.export',['daterange' => 'x1' , 'jenis' => 'x2']) }}";
        url = url.replace("x1", $('#daterange').val());
        url = url.replace("x2", $('#jenis').val());
        url = url.replaceAll("&amp;", "&");
        window.open(url, '_blank');
    });
    
    $(document).ready(function () {
        var table = $('#pengembalian-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('pengembalian.list')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'detail_pinjaman',
                    name: 'getDetail.buku_id'
                },
                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'tgl_pinjam',
                    name: 'tgl_pinjam'
                },
                {
                    data: 'tgl_kembali',
                    name: 'tgl_kembali'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },                
                {
                    data: 'denda',
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )
                },
                {
                    data: 'hilang',
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )
                },
                {
                    data: 'total',
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )
                },
            ]
        });
        
    });
</script>
@endsection