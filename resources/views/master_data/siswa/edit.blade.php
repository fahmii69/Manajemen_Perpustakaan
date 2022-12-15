@extends('layout/main')

@section('title','Siswa | Update Data Siswa')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Update Data Siswa</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('siswa.update',$siswa->id) }}">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <label for="nisn" class="col-sm-4 col-form-label">NISN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                            name="nisn" value="{{ $siswa->nisn}}" placeholder="Masukan NISN">
                        @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ $siswa->nama}}" placeholder="Masukan Nama Siswa">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="kelas">Masukkan Kelas :</label>
                    </div>
                    <div class="col-md-8">
                        <select class="kelas form-control" name="kelas">
                            @forelse ($kelas ?? [] as $v)
                            <option value={{ $v}} {{ $siswa->kelas === $v ? 'selected' : '' }}>{{ $v }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal lahir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                            name="tgl_lahir" value="{{ $siswa->tgl_lahir}}">
                        @error('tgl_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat" value="{{ $siswa->alamat}}" placeholder="Alamat Siswa">
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin :</label>
                    <div class="col-sm-8">
                        <select name="jenis_kelamin" id="jenis_kelamin" class="jenis_kelamin form-control">
                            @foreach ($jenis_kelamin as $jk)
                            <option value="{{ $jk }}" {{ $siswa->jenis_kelamin === $jk ? 'selected' : '' }}>{{ $jk }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <x-tombol_addback_form back=siswa status=Update/>
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
