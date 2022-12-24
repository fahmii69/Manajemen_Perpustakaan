<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Nama Siswa</th>
            <th>Tgl. Pinjam</th>
            <th>Tgl. Kembali</th>
            <th>Tgl. Pengembalian</th>
            <th>Denda Terlambat</th>
            <th>Denda Kehilangan</th>
            <th>Total Denda</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $item)
        <tr>
            
            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->getDetail->where('status', 'DIKEMBALIKAN')->pluck('judul_buku')->implode(' ')}}</td>
            <td>{{ $item->nama_siswa }}</td>
            <td>{{ $item->tgl_pinjam }}</td>
            <td>{{ $item->tgl_kembali }}</td>
            <td>{{ $item->updated_at->format('Y-m-d') }}</td>
            <td>{{ $item->denda !== 0 ? $item->denda : ''}}</td>
            <td>{{ $item->hilang !== 0 ? $item->hilang : '' }}</td>
            <td>{{ $item->total !== 0 ? $item->total : '' }}</td>
        </tr>
        @empty
        @endforelse
    </tbody>
</table>