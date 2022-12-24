<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Nama Siswa</th>
            <th>Tgl. Pinjam</th>
            <th>Tgl. Kembali</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->getDetail->where('status', 'SEDANG_DIPINJAM')->pluck('judul_buku')->implode(' ')}}</td>
            <td>{{ $item->nama_siswa }}</td>
            <td>{{ $item->tgl_pinjam }}</td>
            <td>{{ $item->tgl_kembali }}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>