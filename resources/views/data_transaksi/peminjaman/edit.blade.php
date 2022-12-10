@extends('layout/main')

@section('title','Pegawai | Update Data')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Update Data Peminjaman</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('peminjaman.update',$peminjaman->id) }}">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <label for="judul" class="col-sm-4 col-form-label">Judul Peminjaman</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                            name="judul" value="{{ $peminjaman->judul}}" placeholder="Masukan Judul Peminjaman">
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="kategori">Kategori Peminjaman</label>
                    </div>
                    <div class="col-md-8">
                        <select class="kategori form-control" name="kategori" >
                            @forelse ($kategori as $v)
                            <option value="{{ $v->nama_kategori }}" {{ $peminjaman->kategori === $v ? 'selected' : '' }}>{{ $v->nama_kategori }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="penerbit">Penerbit Peminjaman</label>
                    </div>
                    <div class="col-md-8">
                        <select class="penerbit form-control" name="penerbit" >
                            @forelse ($penerbit as $v)
                            <option value="{{ $v->nama_penerbit }}" {{ $peminjaman->penerbit === $v ? 'selected' : '' }}>{{ $v->nama_penerbit }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pengarang" class="col-sm-4 col-form-label">Pengarang</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('pengarang') is-invalid @enderror" id="pengarang"
                            name="pengarang" value="{{$peminjaman->pengarang}}" placeholder="Masukan Nama Pengarang">
                        @error('pengarang')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun_terbit" class="col-sm-4 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit"
                            name="tahun_terbit" value="{{ $peminjaman->tahun_terbit }}" placeholder="Masukan Tahun Terbit">
                        @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="isbn" class="col-sm-4 col-form-label">isbn</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn"
                            name="isbn" value="{{ $peminjaman->isbn }}" placeholder="Masukkan ISBN">
                        @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jumlah_peminjaman" class="col-sm-4 col-form-label">Jumlah Peminjaman</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('jumlah_peminjaman') is-invalid @enderror" id="jumlah_peminjaman"
                            name="jumlah_peminjaman" value="{{ $peminjaman->jumlah_peminjaman}}" placeholder="Masukan Jumlah Peminjaman">
                        @error('jumlah_peminjaman')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rak_peminjaman" class="col-sm-4 col-form-label">Rak Peminjaman</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('rak_peminjaman') is-invalid @enderror" id="rak_peminjaman"
                            name="rak_peminjaman" value="{{ $peminjaman->rak_peminjaman}}" placeholder="Masukan Rak Peminjaman">
                        @error('rak_peminjaman')
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
        $('.kategori').select2({
            placeholder: "-- Pilih Kategori Peminjaman --",
            allowClear : true
        });
        $('.penerbit').select2({
            placeholder: "-- Pilih Penerbit Peminjaman --",
            allowClear : true
        });
    });
</script>
<!-- /.container-fluid -->
@endsection
