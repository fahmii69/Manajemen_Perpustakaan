@extends('layout/main')

@section('title','Peminjaman | Tambah Peminjaman Buku')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Tambah Data Peminjaman</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('peminjaman.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="No. Pinjam" class="col-sm-4 col-form-label">No. Pinjam</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="No. Pinjam" name="No. Pinjam" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="nama_siswa">Nama nama_siswa</label>
                    </div>
                    <div class="col-md-8">
                        <select class="siswa form-control" name="nama_siswa">
                            @forelse ($siswa as $v)
                            <option value="" selected>-- Pilih Nama Siswa --</option>
                            <option value="{{ $v->nama }}">{{ $v->nama }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="judul">Judul Buku</label>
                    </div>
                    <div class="col-md-8">
                        <select class="judul form-control" name="buku_id">
                            @forelse ($judul as $v)
                            <option value="" selected>-- Pilih Judul Buku --</option>
                            <option value="{{ $v->id }}">{{ $v->judul }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_pinjam" class="col-sm-4 col-form-label">Tanggal Pinjam</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('tgl_pinjam') is-invalid @enderror"
                            id="tgl_pinjam" name="tgl_pinjam" readonly value="{{ date('Y-m-d')}}">
                        @error('tgl_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_kembali" class="col-sm-4 col-form-label">Tanggal Kembali</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('tgl_kembali') is-invalid @enderror"
                            id="tgl_kembali" name="tgl_kembali" readonly
                            value="{{ date('Y-m-d', strtotime('+1 week'))}}">
                        @error('tgl_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <a href="/peminjaman" class="btn btn-success btn-icon-split">
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
        $('.siswa').select2({
            placeholder: "-- Pilih Nama Siswa --",
            allowClear : true
        });
        $('.judul').select2({
            placeholder: "-- Pilih Judul Buku --",
            allowClear : true
        });
    });
</script>
<!-- /.container-fluid -->
@endsection