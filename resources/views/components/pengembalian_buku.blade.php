<div class="containerBuku">
    <input type="text" class="form-control" value='{{ $item->judul_buku }}' readonly>
    <input type="hidden" class="form-control buku_id" value='{{ $item->buku_id }}'>
    <input type="hidden" class="form-control detail_id" value='{{ $item->id }}'>
        <select class="status form-control status">
            @forelse ($status as $st)
            <option value='{{ $st }}' {{ $item->status == $st ? 'selected' : '' }}>{{ $st }}</option>
            @empty
            @endforelse
        </select>
        <br>
</div>