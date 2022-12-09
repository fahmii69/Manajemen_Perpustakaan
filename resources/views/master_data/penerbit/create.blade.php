@extends('layout/main')

@section('title','Penerbit | Tambah Penerbit')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    
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

<!-- script select2  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function () {
        $('.kelas').select2();
        $('.jenis_kelamin').select2();
    });
</script>
<!-- /.container-fluid -->
@endsection