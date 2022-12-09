@extends('layout/main')

@section('title','Penerbit | Tambah Penerbit')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Tambah Data Penerbit</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('penerbit.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="kode_penerbit" class="col-sm-4 col-form-label">Kode Penerbit Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('kode_penerbit') is-invalid @enderror" id="kode_penerbit"
                            name="kode_penerbit" value="{{ old('kode_penerbit')}}" placeholder="Masukan Kode Penerbit Buku">
                        @error('kode_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_penerbit" class="col-sm-4 col-form-label">Nama Penerbit Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror" id="nama_penerbit"
                            name="nama_penerbit" value="{{ old('nama_penerbit')}}" placeholder="Masukan Nama Penerbit Buku">
                        @error('nama_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <a href="/penerbit" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-circle-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Tambah Data</span>
                </button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
