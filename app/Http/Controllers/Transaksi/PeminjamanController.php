<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PeminjamanEditRequest;
use App\Http\Requests\Transaksi\PeminjamanPostRequest;
use App\Models\Buku\Buku;
use App\Models\Siswa;
use App\Models\Transaksi\PeminjamanBuku;
use App\Models\Transaksi\PeminjamanDetail;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
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
            $data = PeminjamanBuku::whereStatus('SEDANG_DIPINJAM')->with('getDetail')->latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('detail_pinjaman', function ($data) {
                    return $data->getDetail->where('status', 'SEDANG_DIPINJAM')->pluck('judul_buku')->toArray();
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

            $peminjaman =
                new PeminjamanBuku($request->safe(
                    ['nama_siswa', 'tgl_pinjam', 'tgl_kembali']
                ));
            $peminjaman->save();
            // foreach($request->id_buku as $buku) {
            // Detail::wherePeminjamanId($id)->delete();

            // $oldDetail = select detail where peminjaman id = 1

            // foreach(detail){
            //     $buku = buku::find(detail)

            //     $buku->stok += 1;

            //     $buku->save();
            // }

            // Detail::wherePeminjamanId($id)->delete();
            foreach ($request->buku_id as $buku_id) {
                $buku       = Buku::find($buku_id);
                $buku->jumlah_buku = $buku->jumlah_buku - 1;
                // dd($buku);
                $buku->update();

                PeminjamanDetail::create([
                    'buku_id' => $buku_id,
                    'peminjaman_id' => $peminjaman->id,
                    'status' => 'SEDANG_DIPINJAM',
                ]);
            }
        });

        Alert::success('Success', 'Data Buku Yang Dipinjamkan Berhasil Didaftarkan !!!');
        return redirect('/peminjaman');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(PeminjamanBuku $peminjaman): JsonResponse
    {
        $peminjaman->getDetail;
        // dd($peminjaman->getDetail);
        $blade = "";
        foreach ($peminjaman->getDetail as $item) {
            $blade .= FacadesView::make('components.perpanjang_buku', compact('item'));
        }
        return response()->json(['peminjaman' => $peminjaman, 'blade' => $blade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeminjamanEditRequest $request, PeminjamanBuku $peminjaman)
    {
        DB::transaction(function () use ($request, $peminjaman) {

            $peminjaman->fill($request->safe(
                ['nama_siswa', 'tgl_pinjam', 'tgl_kembali',]
            ));
            $peminjaman->update();
        });
        return response()->json(['success' => "Berhasil melakukan update data"]);
    }
}
