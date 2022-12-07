<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
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
