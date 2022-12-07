<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    // 1. di database ada siswa
    // 2. https://anekaweb.com/anekaperpus/index.php?p=home base belajar web
    // 3. validasi request seperti validasi laravel ui, coba cek cek
    // 4. tgl lahir pake select2 kayaknya, coba pelajari
    public function index()
    {
        return view('index');
    }

    public function getSiswa(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::query();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('siswa.tombol', compact('data'));
                })
                ->make(true);
        }
    }
}
