<?php

namespace App\Exports;

use App\Models\Transaksi\PeminjamanBuku;
use App\Models\Transaksi\PeminjamanDetail;
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
        public string $startDate,
        public string $endDate
    ) {
    }

    /**
     * Exporting data to excel.
     *
     * @return View
     */
    public function view(): View
    {
        $this->startDate = Carbon::createFromFormat("d/m/Y", $this->startDate)->format('Y-m-d') . " 00:00:00";
        $this->endDate   = Carbon::createFromFormat("d/m/Y", $this->endDate)->format('Y-m-d') . " 23:59:59";

        if ($this->jenis == "Peminjaman") {

            $data = PeminjamanBuku::whereStatus('SEDANG_DIPINJAM')->whereBetween('tgl_pinjam', [$this->startDate, $this->endDate])->latest('id')->get();
            // dd($data);

            return view('data_transaksi.laporan.peminjaman', compact('data'));
        }

        if ($this->jenis == "Pengembalian") {

            $data = PeminjamanBuku::whereStatus('DIKEMBALIKAN')->whereBetween('updated_at', [$this->startDate, $this->endDate])->latest('updated_at')->get();

            return view('data_transaksi.laporan.pengembalian', compact('data'));
        }

        if ($this->jenis == "BukuHilang") {

            $data = PeminjamanDetail::whereStatus('HILANG')->whereBetween('updated_at', [$this->startDate, $this->endDate])->latest('updated_at')->get();

            return view('data_transaksi.laporan.excel-buku', compact('data'));
        }
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
