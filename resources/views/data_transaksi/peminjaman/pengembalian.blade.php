@extends('layout.main')

@section('title','Data Pengembalian')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Pengembalian</span>
    </i>
    <div class="card shadow mb-4">
        @include('sweetalert::alert')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pengembalian-dataTable" width="100%" cellspacing="0">
                    <thead>
                            <th>No. Pinjam</th>
                            <th>Judul</th>
                            <th>Nama Siswa</th>
                            <th>Tgl. Pinjam</th>
                            <th>Tgl. Kembali</th>
                            <th>Status</th>
                            <th>Tgl. Pengembalian</th>
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
<script></script>
<script>
   
 
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
                {data: 'bukus', name: 'getJudul.judul'},
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
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },                
                {
                    data: 'denda',
                    name: 'denda',
                },
            ]
        });
        
    });
</script>
@endsection