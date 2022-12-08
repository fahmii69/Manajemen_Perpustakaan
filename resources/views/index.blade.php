@extends('layout.main')

@section('title','Perpustakaan Zoel')

@section('content')

    <!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Siswa</span>
    </i>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="yajra-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Tgl.Lahir</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
    
    @section('script')
    @include('layout.script');
    @endsection

