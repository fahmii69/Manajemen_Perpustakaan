@extends('layout/main')

@section('title','Penerbit | Tambah Penerbit')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Tambah Data Penerbit</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('penerbit.store') }}">
                @csrf
                <div class="form-group" id="addKodePenerbit">
                    <div class="containerPenerbit row">
                        <label for="kode_penerbit" class="col-sm-4 col-form-label">Kode Penerbit Buku</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('kode_penerbit') is-invalid @enderror"
                                id="kode_penerbit" name="kode_penerbit" value="{{ old('kode_penerbit')}}"
                                placeholder="Masukan Kode Penerbit Buku"> 
                            @error('kode_penerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group row" id="addNamaPenerbit">
                    <label for="nama_penerbit" class="col-sm-4 col-form-label">Nama Penerbit Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror"
                            id="nama_penerbit" name="nama_penerbit" value="{{ old('nama_penerbit')}}"
                            placeholder="Masukan Nama Penerbit Buku">
                        @error('nama_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="containerButton d-flex justify-content-between">
                    <div class="left-side">
                        <x-tombol_addback_form back=penerbit status=Tambah/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
