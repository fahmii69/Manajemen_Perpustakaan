<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\SiswaEditRequest;
use App\Http\Requests\Siswa\SiswaPostRequest;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    // status message ganti dengan sweetalert2
    public function index()
    {
        return view('index');
    }

    public function indexSiswa()
    {
        return view('master_data.siswa.index');
    }

    public function create()
    {
        $kelas = ['a', 'b', 'c', 'd','e'];
        $jenis_kelamin = ['Laki - Laki', 'Perempuan'];
        
        return view('master_data.siswa.create',['kelas' => $kelas, 'jenis_kelamin' => $jenis_kelamin]);
    }

    public function edit(Siswa $siswa)
    {
        $kelas         = ['a', 'b', 'c', 'd','e'];
        $jenis_kelamin = ['Laki - Laki', 'Perempuan'];
        
        return view('master_data.siswa.edit',[
            'kelas' => $kelas, 
            'siswa' => $siswa, 
            'jenis_kelamin' => $jenis_kelamin]
        );
    }

    public function getSiswa(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('master_data.siswa.tombol', compact('data'));
                })
                ->make(true);
        }
    }

    public function store(SiswaPostRequest $request ) 
    {
        DB::transaction(function () use ($request) {

            $siswa = new Siswa($request->safe(
                ['nisn', 'nama', 'kelas', 'tgl_lahir', 'alamat','jenis_kelamin']
            ));

            $siswa->save();
        });
        return redirect('/siswa')->with('status', 'Data Pegawai berhasil DITAMBAHKAN.');
        ;
    }

    public function update(SiswaEditRequest $request, Siswa $siswa ) 
    {
        DB::transaction(function () use ($request,$siswa) {

            $siswa ->fill($request->safe(
                ['nisn', 'nama', 'kelas', 'tgl_lahir', 'alamat','jenis_kelamin']
            ));    
            $siswa->saveOrFail();
        });
        return redirect('/siswa')->with('status', 'Data Pegawai berhasil DITAMBAHKAN.');
        ;
    }

    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa->id);

        return response()->json(['success' => true, 'message' => 'Data Pegawai berhasil DIHAPUS']);
    }
}
