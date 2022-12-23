<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\BaseController;
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
use Illuminate\Support\Facades\Gate;


class PeminjamanController extends BaseController
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
            $data = PeminjamanBuku::whereStatus('SEDANG_DIPINJAM')->latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('detail_pinjaman', function ($data) {
                    return $data->getDetail->where('status', 'SEDANG_DIPINJAM')->pluck('judul_buku')->toArray();
                })
                ->addColumn('aksi', function ($data) {
                    if ($this->roleName == 'Admin') {
                        return view('data_transaksi.peminjaman.tombol', compact('data'));
                    }
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.  
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        $siswa = Siswa::get();
        $judul = Buku::get();
        if ($this->auth->can('peminjaman.create')) {
            return view('data_transaksi.peminjaman.create', ['siswa' => $siswa, 'judul' => $judul]);
        } else {
            Alert::error('Error', 'Anda tidak memiliki akses untuk ke halaman ini 😝 !!!');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanPostRequest $request
     * @return RedirectResponse
     */
    public function store(PeminjamanPostRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $peminjaman =
                new PeminjamanBuku($request->safe(
                    ['nama_siswa', 'tgl_pinjam', 'tgl_kembali']
                ));
            $peminjaman->user_id = 1;
            $peminjaman->save();

            foreach ($request->buku_id as $buku_id) {
                $buku       = Buku::find($buku_id);
                $buku->jumlah_buku = $buku->jumlah_buku - 1;
                $buku->update();

                PeminjamanDetail::create([
                    'buku_id' => $buku_id,
                    'peminjaman_id' => $peminjaman->id,
                    'status' => 'SEDANG_DIPINJAM',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        DB::commit();

        Alert::success('Success', 'Data Buku Yang Dipinjamkan Berhasil Didaftarkan !!!');
        return redirect('/peminjaman');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PeminjamanBuku  $peminjaman
     * @return JsonResponse
     */
    public function edit(PeminjamanBuku $peminjaman): JsonResponse
    {
        $blade = "";
        foreach ($peminjaman->getDetail as $item) {
            $blade .= FacadesView::make('components.perpanjang_buku', compact('item'));
        }
        return response()->json(['peminjaman' => $peminjaman, 'blade' => $blade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeminjamanEditRequest $request
     * @param PeminjamanBuku $peminjaman
     * @return JsonResponse
     */
    public function update(PeminjamanEditRequest $request, PeminjamanBuku $peminjaman): JsonResponse
    {
        $response = [
            'success' => false,
        ];

        DB::beginTransaction();

        try {

            Gate::authorize('update', $peminjaman);

            $peminjaman->fill($request->safe(
                ['nama_siswa', 'tgl_pinjam', 'tgl_kembali']
            ));
            $peminjaman->update();

            $response['message'] = "Berhasil melakukan update data";
            $response['success'] = true;
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        DB::commit();

        return response()->json($response);
    }
}
