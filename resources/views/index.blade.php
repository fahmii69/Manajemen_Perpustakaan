@extends('layout.main')

@section('title','Datatable')

@section('content')

    <!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        {{-- <span class="h3 mb-4 text-gray-800">Data Siswa</span> --}}
    </i>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="" class="btn btn-success btn-icon-split tombol-tambah">
                <span class="icon text-white-50">
                    <i class="fas fa-user-plus"></i>
                </span>
                <span class="text">Tambah Data</span>
            </a>
        </div>

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
    @include('siswa.script');
    
    @endsection
    {{-- @include('siswa.tombol'); --}}

