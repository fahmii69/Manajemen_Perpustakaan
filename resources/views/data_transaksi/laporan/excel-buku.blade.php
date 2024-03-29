<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Buku</th>
            <th>Nama Siswa</th>
            <th>Tgl. Laporan Hilang</th>
            <th>Harga Buku</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->buku->judul}}</td>
            <td>{{ $item->peminjaman->nama_siswa }}</td>
            <td>{{ $item->updated_at->format('d-M-Y') }}</td>
            <td>{{ $item->hilang != 0 ? $item->hilang : ''  }}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>