<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PeminjamanEditRequest;
use App\Http\Requests\Transaksi\PeminjamanPostRequest;
use App\Models\Buku\Buku;
use App\Models\Siswa;
use App\Models\Transaksi\DetailPinjaman;
use App\Models\Transaksi\PeminjamanBuku;
use Carbon\Carbon;
use DB;
use Exception;
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
     * Page index
     *
     * @return View
     */
    public function pengembalian(): View
    {

        return view('data_transaksi.peminjaman.pengembalian');
    }

    public function getPengembalian(Request $request)
    {
        if ($request->ajax()) {
            $data = PeminjamanBuku::whereStatus('Dikembalikan')->with('getJudul')->latest('updated_at');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('bukus', function ($data) {
                    return $data->getJudul->judul;
                })
                ->editColumn('updated_at', function ($data) {
                    return Carbon::parse($data->updated_at)->format('Y-m-d');
                })
                ->make(true);
        }
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
                    return $data->getDetail->pluck('judul_buku')->toArray();
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
            $peminjaman->status = 'SEDANG_DIPINJAM';
            $peminjaman->save();
            // $tes = PeminjamanBuku::create($peminjaman);
            // dd($tes);
            // dd($detail_peminjaman);

            // foreach($request->id_buku as $buku) {
            // Detail::wherePeminjamanId($id)->delete();

            // $oldDetail = select detail where peminjaman id = 1

            // foreach(detail){
            //     $buku = buku::find(detail)

            //     $buku->stok += 1;

            //     $buku->save();
            // }

            // Detail::wherePeminjamanId($id)->delete();
            foreach ($request->daftar_buku as $buku_id) {
                $buku       = Buku::find($buku_id);
                $buku->jumlah_buku = $buku->jumlah_buku - 1;
                $buku->update();

                DetailPinjaman::create([
                    'buku_id' => $buku_id,
                    // 'peminjaman_id' => $getDetail->id,

                ]);
            }

            // $jml_buku = Buku::whereId($request->buku_id)->select('jumlah_buku')->get();
            // $total = $jml_buku[0]->jumlah_buku - 1;
            // Buku::whereId($request->buku_id)->update(['jumlah_buku' => $total]);
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
        return response()->json($peminjaman);
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
                ['buku_id', 'nama_siswa', 'tgl_pinjam', 'tgl_kembali',]
            ));
            $peminjaman->update();
        });
        return response()->json(['success' => "Berhasil melakukan update data"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pengembalianBuku(Request $request, PeminjamanBuku $peminjaman)
    {
        DB::beginTransaction();
        $response = [
            'success' => false
        ];

        try {
            $peminjaman->updated_at = Carbon::now();
            $total = getDenda($peminjaman);

            $peminjaman->update(['denda' => $total, 'status' => 'Dikembalikan', 'updated_at' => Carbon::now()]);

            $jml_buku = Buku::whereId($peminjaman->buku_id)->select('jumlah_buku')->get();
            $total = $jml_buku[0]->jumlah_buku + 1;
            Buku::whereId($peminjaman->buku_id)->update(['jumlah_buku' => $total]);

            $response['success'] = true;
            $response['message'] = "Berhasil dikembalikan";
        } catch (Exception $e) {
            DB::rollBack();

            $response['message'] = $e->getMessage();
        }

        DB::commit();

        return response()->json($response);
    }
}
