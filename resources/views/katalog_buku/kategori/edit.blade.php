@extends('layout/main')

@section('title','Pegawai | Update Data')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Update Data Kategori</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('kategori.update',$kategori->id) }}">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <label for="kode_kategori" class="col-sm-4 col-form-label">Kode Kategori</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('kode_kategori') is-invalid @enderror" id="kode_kategori"
                            name="kode_kategori" value="{{ $kategori->kode_kategori}}" placeholder="Masukan Kode Kategori">
                        @error('kode_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_kategori" class="col-sm-4 col-form-label">Nama Kategori</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                            name="nama_kategori" value="{{ $kategori->nama_kategori}}" placeholder="Masukan Nama Kategori">
                        @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <a href="/kategori" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-circle-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Update Data</span>
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
