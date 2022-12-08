<form action="/siswa/edit/{{$data->id}}" >
    @method('patch')
    @csrf
    <button type="submit" class="btn btn-success btn-sm tombol-edit">Edit</button>
</form>

<a href='#' data-id="{{ $data->id }}" class="btn btn-danger btn-sm btn-delete">Del</a>