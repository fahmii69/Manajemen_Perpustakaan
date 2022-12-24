<?php

namespace App\Http\Controllers\Transaksi;

use App\Exports\LaporanExport;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends BaseController
{
    public function index()
    {
        $jenis = ['Peminjaman', 'Pengembalian'];

        return view('data_transaksi.laporan.index', ['jenis' => $jenis]);
    }

    /**
     * Export data to excel.
     *
     * @param Request $request
     */
    public function export(Request $request)
    {
        $jenis = $request->jenis;

        return Excel::download(new LaporanExport($jenis), "List $jenis buku.xlsx");
    }
}
