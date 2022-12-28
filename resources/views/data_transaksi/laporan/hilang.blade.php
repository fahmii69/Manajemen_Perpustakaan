@extends('layout.main')

@section('title','Data Buku Hilang')

@section('content')
@include('sweetalert::alert')

<!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Buku Hilang</span>
    </i>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-md-4">
                <label for="" class="row">Date Range</label>
                <input type="text" name="daterange" class="form-control row" value="" id="daterange" />
                <br>
                <button class="row btn btn-success btn-icon-split btn-export">
                    <input type="hidden" name="jenis" class="form-control row" value="BukuHilang" id="jenis" />
                    <span class="icon text-white-50">
                        <i class="fas fa-file"></i>
                    </span>
                    <span class="text" >Export Excel</span>
                </button>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered" id="bukuHilang-dataTable" width="100%" cellspacing="0">
                    <thead>
                            <th>#</th>
                            <th>Buku</th>
                            <th>Nama Siswa</th>
                            <th>Tgl. Laporan Hilang</th>
                            <th>Denda</th>
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
    $(document).on('click', '.btn-export', function(){
        let url = "{{ route('laporan.export',['daterange' => 'x1' , 'jenis' => 'x2']) }}";
        url = url.replace("x1", $('#daterange').val());
        url = url.replace("x2", $('#jenis').val());
        url = url.replaceAll("&amp;", "&");
        window.open(url, '_blank');
    });
    
    $(document).ready(function () {
        var table = $('#bukuHilang-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('laporan.hilang.list')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'buku_id',
                    name: 'buku.buku_id'
                },
                {
                    data: 'peminjaman_id',
                    name: 'peminjaman.nama_siswa'
                },
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'hilang',
                    name: 'hilang'
                },
            ]
        });

        let date = new Date();
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();

        // This arrangement can be altered based on how we want the date's format to appear.
        let currentDate = `${year}-${month}-${day}`;
        fetch_data(currentDate, currentDate);

        function fetch_data(startDate, endDate)
        {
            table.ajax.url(`/laporan/hilang/data?action=fetch&startDate=${startDate}&endDate=${endDate}`).load()
        
        };

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
            fetch_data(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));
        });
    });
        
    });
</script>
@endsection