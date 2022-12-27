<div class="containerBuku row mb-1" >
    <div class="col-sm-6">
    <input type="text" class="form-control" value='{{ $item->judul_buku }}' readonly>
    </div>
    <input type="hidden" class="form-control buku_id" value='{{ $item->buku_id }}'>
    <input type="hidden" class="form-control detail_id" value='{{ $item->id }}'>
    <div class="col-sm-3">
        <select class="status form-control status">
            @forelse ($status as $st)
            <option value='{{ $st }}' {{ $item->status == $st ? 'selected' : '' }}>{{ $st }}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="col-sm-3">
        <input type="text" class="form-control bukuHilang" readonly>
    </div>
    <br>
</div>