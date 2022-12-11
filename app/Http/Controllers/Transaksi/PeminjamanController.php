<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PeminjamanPostRequest;
use App\Models\Buku\Buku;
use App\Models\Siswa;
use App\Models\Transaksi\PeminjamanBuku;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class PeminjamanController extends Controller
{
    /**
     * Page index
     *
     * @return View
     */
    public function index(): View
    {
        return view('data_transaksi.peminjaman.index');
    }

    /**
     * get data from database for datatable.
     *
     * @param Request $request
     */
    public function getPeminjaman(Request $request)
    {
        if ($request->ajax()) {
            $data = PeminjamanBuku::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('bukus', function ($data) {
                    return $data->getJudul->judul;
                })
                ->addColumn('aksi', function ($data) {
                    return view('data_transaksi.peminjaman.tombol', compact('data'));
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $siswa = Siswa::get();
        $judul = Buku::get();
        return view('data_transaksi.peminjaman.create', ['siswa' => $siswa, 'judul' => $judul]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanPostRequest $request
     * @return RedirectResponse
     */
    public function store(PeminjamanPostRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $peminjaman = new PeminjamanBuku($request->safe(
                ['buku_id', 'nama_siswa', 'tgl_pinjam', 'tgl_kembali',]
            ));
            $peminjaman->save();

            $jml_buku = Buku::where('id', '=', $request->buku_id)->select('jumlah_buku')->get();
            $total = $jml_buku[0]->jumlah_buku - 1;

            Buku::where('id', $request->buku_id)->update(['jumlah_buku' => $total]);
        });

        Alert::success('Success', 'Data Buku Yang Dipinjamkan Berhasil Didaftarkan !!!');
        return redirect('/peminjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(PeminjamanBuku $employee): JsonResponse
    {

        return response()->json($employee);
    }

    public function getEdit(PeminjamanBuku $employee): JsonResponse
    {

        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}