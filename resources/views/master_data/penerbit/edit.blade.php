@extends('layout/main')

@section('title','Penerbit | Update Data')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Update Data Penerbit</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">
            <form method="post" action="{{ route('penerbit.update',$penerbit->id) }}">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <label for="kode_penerbit" class="col-sm-4 col-form-label">Kode Penerbit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('kode_penerbit') is-invalid @enderror" id="kode_penerbit"
                            name="kode_penerbit" value="{{ $penerbit->kode_penerbit}}" placeholder="Masukan Kode Penerbit">
                        @error('kode_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_penerbit" class="col-sm-4 col-form-label">Nama Penerbit</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror" id="nama_penerbit"
                            name="nama_penerbit" value="{{ $penerbit->nama_penerbit}}" placeholder="Masukan Nama Penerbit">
                        @error('nama_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <x-tombol_addback_form back=penerbit status=Update/>
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
