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
            <form method="post" action="{{ route('about.update') }}">
                @method('patch')
                @csrf
                @foreach ($data as $key )
                <div class="form-group row">
                    <label for="{{ $key }}" class="col-sm-4 col-form-label">{{ getDescription($key) }}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('{{ $key }}') is-invalid @enderror"
                            id="{{ $key }}" name="{{ $key }}" value="{{ getSetting($key)}}"
                            placeholder="Masukan Nama Penerbit">
                        @error('{{ $key }}')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                @endforeach
                <hr>
                <x-tombol_addback_form back="" status=Update />
            </form>
        </div>
    </div>
</div>
// $settings->description = $key;
$setting->value = $v;
$setting->save();

data = [
nama_penerbit => asdas,
alamat => asdasd
]

nama_penerbit = asd,
alamat = asd,'

foreach(key as key => v){
    setting::whereKey(key)->first();
    setting->value = v
    setting->save();
    }


setting::whereKey(nama_penerbit)->update(value= v);
setting::whereKey(alamat)->update(value= v);

<!-- script select2  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function () {
        $('.laporan').select2({
            placeholder: "-- Pilih Jenis Laporan --",
            allowClear: true
        });
    });

</script>
@endsection
