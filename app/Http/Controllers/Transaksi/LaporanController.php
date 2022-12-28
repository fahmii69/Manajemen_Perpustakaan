<?php

namespace App\Http\Controllers\Transaksi;

use App\Exports\LaporanExport;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\PeminjamanBuku;
use App\Models\Transaksi\PeminjamanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class LaporanController extends BaseController
{
    public function index()
    {
        $jenis = ['Peminjaman', 'Pengembalian'];

        return view('data_transaksi.laporan.index', ['jenis' => $jenis]);
    }

    public function indexBukuHilang()
    {
        $jenis = ['Peminjaman', 'Pengembalian'];

        return view('data_transaksi.laporan.hilang', ['jenis' => $jenis]);
    }

    public function getBukuHilang(Request $request)
    {
        if ($request->ajax()) {
            $data = PeminjamanDetail::whereStatus('HILANG')->whereBetween('updated_at', [$request->startDate  . " 00:00:00", $request->endDate  . " 23:59:59"])->latest('updated_at');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('buku_id', function ($data) {
                    return $data->buku->judul;
                })
                ->editColumn('peminjaman_id', function ($data) {
                    return $data->peminjaman->nama_siswa;
                })
                ->editColumn('updated_at', function ($data) {
                    return Carbon::parse($data->updated_at)->format('Y-m-d');
                })
                ->make(true);
        }
    }

    /**
     * Export data to excel.
     *
     * @param Request $request
     */
    public function export(Request $request)
    {

        $jenis = $request->jenis;
        $dateRange = $request->daterange;
        $date = explode(' - ', $dateRange);
        $startDate = $date[0];
        $endDate = $date[1];

        $carbonStart = Carbon::createFromFormat("d/m/Y", $startDate)->format('d-M-Y');
        $carbonEnd = Carbon::createFromFormat("d/m/Y", $endDate)->format('d-M-Y');

        return Excel::download(new LaporanExport($jenis, $startDate, $endDate), "List $jenis ($carbonStart to $carbonEnd) buku.xlsx");
    }
}
