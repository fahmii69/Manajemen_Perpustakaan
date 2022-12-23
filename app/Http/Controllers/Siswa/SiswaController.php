<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\SiswaEditRequest;
use App\Http\Requests\Siswa\SiswaPostRequest;
use App\Models\Buku\Buku;
use App\Models\Siswa;
use App\Models\Transaksi\PeminjamanBuku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    /**
     * Dashboard Page Index.
     *
     * @return View
     */
    public function index(): View
    {
        $buku  = Buku::get();
        $siswa = Siswa::get();
        $peminjaman = PeminjamanBuku::whereStatus('SEDANG_DIPINJAM')->get();
        $pengembalian = PeminjamanBuku::whereStatus('DIKEMBALIKAN')->get();

        return view('index', compact('buku', 'siswa', 'peminjaman', 'pengembalian'));
    }

    /**
     * Siswa Page Index.
     *
     * @return View
     */
    public function indexSiswa(): View
    {
        return view('master_data.siswa.index');
    }

    /**
     * Get Data from Database for Datatable.
     *
     * @param Request $request
     */
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

    /**
     * Tambah data Page
     *
     * @return View
     */
    public function create(): View
    {
        $kelas = ['a', 'b', 'c', 'd', 'e'];
        $jenis_kelamin = ['Laki - Laki', 'Perempuan'];

        return view('master_data.siswa.create', ['kelas' => $kelas, 'jenis_kelamin' => $jenis_kelamin]);
    }

    /**
     * store data to database.
     *
     * @param SiswaPostRequest $request
     * @return RedirectResponse
     */
    public function store(SiswaPostRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $siswa = new Siswa($request->safe(
                ['nisn', 'nama', 'kelas', 'tgl_lahir', 'alamat', 'jenis_kelamin']
            ));

            $siswa->save();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        DB::commit();

        Alert::success('Success', 'Data Siswa Berhasil Didaftarkan !!!');
        return redirect('/siswa');
    }

    /**
     * Edit data Page.
     *
     * @param Siswa $siswa
     * @return View
     */
    public function edit(Siswa $siswa): View
    {
        $kelas         = ['a', 'b', 'c', 'd', 'e'];
        $jenis_kelamin = ['Laki - Laki', 'Perempuan'];

        return view(
            'master_data.siswa.edit',
            [
                'kelas' => $kelas,
                'siswa' => $siswa,
                'jenis_kelamin' => $jenis_kelamin
            ]
        );
    }

    /**
     * Update data from database.
     *
     * @param SiswaEditRequest $request
     * @param Siswa $siswa
     * @return RedirectResponse
     */
    public function update(SiswaEditRequest $request, Siswa $siswa): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $siswa->fill($request->safe(
                ['nisn', 'nama', 'kelas', 'tgl_lahir', 'alamat', 'jenis_kelamin']
            ));

            $siswa->saveOrFail();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        DB::commit();

        Alert::success('Success', 'Data Siswa Berhasil DiUpdate !!!');
        return redirect('/siswa');
    }

    /**
     * Delete data.
     *
     * @param Siswa $siswa
     * @return JsonResponse
     */
    public function destroy(Siswa $siswa): JsonResponse
    {
        Siswa::destroy($siswa->id);

        return response()->json(['success' => true, 'message' => 'Data Siswa berhasil DIHAPUS']);
    }
}
