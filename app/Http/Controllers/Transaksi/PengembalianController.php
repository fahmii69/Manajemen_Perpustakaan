<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\PeminjamanEditRequest;
use App\Models\Buku\Buku;
use App\Models\Transaksi\PeminjamanBuku;
use App\Models\Transaksi\PeminjamanDetail;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewView;
use Yajra\DataTables\DataTables;

class PengembalianController extends Controller
{
    /**
     * Page index
     *
     * @return View
     */
    public function index(): ViewView
    {
        return view('data_transaksi.peminjaman.pengembalian');
    }

    public function getPengembalian(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $data = PeminjamanBuku::whereStatus('DIKEMBALIKAN')->with('getDetail')->latest('updated_at');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('detail_pinjaman', function ($data) {
                    return $data->getDetail->where('status', 'DIKEMBALIKAN')->pluck('judul_buku')->toArray();
                })
                ->editColumn('updated_at', function ($data) {
                    return Carbon::parse($data->updated_at)->format('Y-m-d');
                })
                ->editColumn('denda', function ($data) {
                    if ($data->denda > 0) {
                        return $data->denda;
                    }
                })
                ->editColumn('hilang', function ($data) {
                    if ($data->hilang > 0) {
                        return $data->hilang;
                    }
                })
                ->editColumn('total', function ($data) {
                    if ($data->total > 0) {
                        return $data->total;
                    }
                })
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function edit(PeminjamanBuku $pengembalian): JsonResponse
    {
        $pengembalian->getDetail;
        $status = ['DIKEMBALIKAN', 'HILANG'];
        $html = "";


        foreach ($pengembalian->getDetail as $item) {
            $html .= View::make('components.pengembalian_buku', compact('item', 'status'));
        }
        return response()->json(['pengembalian' => $pengembalian, 'status' => $status, 'html' => $html]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pengembalianBuku(PeminjamanEditRequest $request, PeminjamanBuku $pengembalian)
    {
        // dd($request->all());
        DB::beginTransaction();
        $response = [
            'success' => false
        ];

        try {
            $pengembalian->fill($request->safe(
                ['nama_siswa', 'tgl_pinjam', 'tgl_kembali', 'hilang']
            ));
            $pengembalian->updated_at = Carbon::now();
            $pengembalian->denda      = getDenda($pengembalian);
            $pengembalian->total      = getTotalDenda($pengembalian);
            $pengembalian->status = 'DIKEMBALIKAN';
            // return $pengembalian;
            $pengembalian->update();

            foreach ($request->detail as $arrayBuku) {
                $detail = PeminjamanDetail::find($arrayBuku['detail_id']);

                if ($arrayBuku['status'] == "DIKEMBALIKAN") {
                    $buku = Buku::find($arrayBuku['buku_id']);
                    $buku->jumlah_buku += 1;
                    $buku->save();
                }

                $detail->status = $arrayBuku['status'];
                $detail->save();
            }
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
