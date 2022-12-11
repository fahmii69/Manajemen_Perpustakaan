{{-- <form action="{{ route('peminjaman.edit',$data->id) }}">
    @method('patch')
    @csrf
    <button type="submit" class="btn btn-warning btn-sm tombol-edit">Perpanjang</button>
</form> --}}
<a href='#' data-id="{{ $data->id }}" class="btn btn-success btn-sm tombol-edit">Pengembalian</a>
<a href='#' data-id="{{ $data->id }}" class="btn btn-success btn-sm btn-delete">Pengembalian2222</a>