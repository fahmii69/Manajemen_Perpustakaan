<?php

namespace App\Exports;

use App\Models\Transaksi\PeminjamanBuku;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class LaporanExport implements FromView, WithColumnFormatting, ShouldAutoSize
{
    public function __construct(
        public string $jenis,
    ) {
    }

    /**
     * Exporting data to excel.
     *
     * @return View
     */
    public function view(): View
    {
        if ($this->jenis == "Peminjaman") {

            $data = PeminjamanBuku::whereStatus('SEDANG_DIPINJAM')->latest('id')->get();

            return view('data_transaksi.laporan.peminjaman', compact('data'));
        }

        $data = PeminjamanBuku::whereStatus('DIKEMBALIKAN')->latest('id')->get();

        return view('data_transaksi.laporan.pengembalian', compact('data'));
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'H' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'I' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }
}
