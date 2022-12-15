@extends('layout/main')

@section('title','Kategori | Tambah Kategori')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Tambah Data Kategori</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('kategori.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="kode_kategori" class="col-sm-4 col-form-label">Kode Kategori Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" id="kode_kategori"
                            name="kode_kategori" value="{{ old('kode_kategori')}}" placeholder="Masukan Kode Kategori Buku">
                        @error('kode_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_kategori" class="col-sm-4 col-form-label">Nama Kategori Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                            name="nama_kategori" value="{{ old('nama_kategori')}}" placeholder="Masukan Nama Kategori Buku">
                        @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <x-tombol_addback_form back=kategori status=Tambah/>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
