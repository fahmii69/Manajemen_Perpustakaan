@extends('layout/main')

@section('title','Laporan | Pilih Laporan')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Laporan Perpustakaan</h1>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 col-6">
        <div class="card-body">

            <form method="post" action="{{ route('laporan.export') }}">
                @method('post')
                @csrf
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="jenis">Jenis Laporan</label>
                    </div>
                    <div class="col-md-8">
                        <select class="laporan form-control" name="jenis" >
                            @forelse ($jenis as $v)
                            <option value="" selected>-- Pilih Jenis Laporan --</option>
                            <option value="{{ $v }}">{{ $v }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <hr>
                <x-tombol_addback_form back="" status=Export/>
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
        $('.laporan').select2({
            placeholder: "-- Pilih Jenis Laporan --",
            allowClear : true
        });
    });
</script>
@endsection
