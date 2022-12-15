@extends('layout/main')

@section('title','Buku | Tambah Buku')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Tambah Data Buku</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('buku.store') }}">
                @csrf
                <div class="form-group row">
                    <label for="judul" class="col-sm-4 col-form-label">Judul Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" value="{{ old('judul')}}" placeholder="Masukan Judul Buku">
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="kategori">Kategori Buku</label>
                    </div>
                    <div class="col-md-8">
                        <select class="kategori form-control" name="kategori" >
                            @forelse ($kategori as $v)
                            <option value="" selected>-- Pilih Kategori Buku --</option>
                            <option value="{{ $v->nama_kategori }}">{{ $v->nama_kategori }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="penerbit">Penerbit Buku</label>
                    </div>
                    <div class="col-md-8">
                        <select class="penerbit form-control" name="penerbit" >
                            @forelse ($penerbit as $v)
                            <option value="" selected>-- Pilih Penerbit Buku --</option>
                            <option value="{{ $v->nama_penerbit }}">{{ $v->nama_penerbit }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pengarang" class="col-sm-4 col-form-label">Pengarang</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang"
                            name="pengarang" value="{{ old('pengarang')}}" placeholder="Masukan Nama Pengarang">
                        @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun_terbit" class="col-sm-4 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit"
                            name="tahun_terbit" value="{{ old('tahun_terbit')}}" placeholder="Masukan Tahun Terbit">
                        @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="isbn" class="col-sm-4 col-form-label">isbn</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn"
                            name="isbn" value="{{ old('isbn')}}" placeholder="Masukkan ISBN">
                        @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jumlah_buku" class="col-sm-4 col-form-label">Jumlah Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('jumlah_buku') is-invalid @enderror" id="jumlah_buku"
                            name="jumlah_buku" value="{{ old('jumlah_buku')}}" placeholder="Masukan Jumlah Buku">
                        @error('jumlah_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rak_buku" class="col-sm-4 col-form-label">Rak Buku</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('rak_buku') is-invalid @enderror" id="rak_buku"
                            name="rak_buku" value="{{ old('rak_buku')}}" placeholder="Masukan Rak Buku">
                        @error('rak_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <x-tombol_addback_form back=buku status=Tambah/>

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
        $('.kategori').select2({
            placeholder: "-- Pilih Kategori Buku --",
            allowClear : true
        });
        $('.penerbit').select2({
            placeholder: "-- Pilih Penerbit Buku --",
            allowClear : true
        });
    });
</script>
<!-- /.container-fluid -->
@endsection
