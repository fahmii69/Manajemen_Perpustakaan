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
                                id="kode_penerbit" name="kode_penerbit[0]" value="{{ old('kode_penerbit')}}"
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
                            id="nama_penerbit" name="nama_penerbit[0]" value="{{ old('nama_penerbit')}}"
                            placeholder="Masukan Nama Penerbit Buku">
                        @error('nama_penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="containerButton d-flex justify-content-between">
                    <div class="left-side">
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
                            <span class="baseNumber">Tambah Data</span>
                        </button>
                    </div>
                    <div class="right-side">
                        <button type="button" name="add" id="add" class="btn btn-success btn-xs"> <i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var i = 0;

    $("#add").click(function () {
        $("#btnRemove").removeClass("disappear");

        ++i;

        $("#addKodePenerbit").append(
            '<div class="containerPenerbit row"> <label for="kode_penerbit" class="col-sm-4 col-form-label"></label><div class="col-sm-8"><input type="text" class="form-control @error('
            kode_penerbit ') is-invalid @enderror"id="kode_penerbit" name="kode_penerbit[' + i +
            ']" value="{{ old('
            kode_penerbit ')}}"placeholder="Masukan Kode Penerbit Buku">@error('
            kode_penerbit ')<div class="invalid-feedback">{{ $message }}</div> @enderror </div> <button class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></button></div>'
        );

        $('#addNamaPenerbit').append(
            '<label for="nama_penerbit" class="col-sm-4 col-form-label"></label><div class="col-sm-8"><input type="text" class="form-control @error('
            nama_penerbit ') is-invalid @enderror"id="nama_penerbit" name="nama_penerbit[' + i +
            ']" value="{{ old('
            nama_penerbit ')}}"placeholder="Masukan Nama Penerbit Buku">@error('
            nama_penerbit ')<div class="invalid-feedback">{{ $message }}</div>@enderror</div></hr>'
        );
    });

    $(document).on('click', '.btn-delete', function(){
        $(this).closest('.containerPenerbit').remove();
    })

</script>

<!-- /.container-fluid -->
@endsection
