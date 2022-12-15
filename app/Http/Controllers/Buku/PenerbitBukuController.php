<?php

namespace App\Http\Controllers\Buku;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\Penerbit\PenerbitEditRequest;
use App\Http\Requests\Buku\Penerbit\PenerbitPostRequest;
use App\Models\Buku\PenerbitBuku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class PenerbitBukuController extends Controller
{
    /**
     * Page index
     *
     * @return View
     */
    public function index(): View
    {
        return view('master_data.penerbit.index');
    }

    /**
     * Get data from Database for Datatable
     *
     * @param Request $request
     */
    public function getPenerbit(Request $request)
    {
        if ($request->ajax()) {
            $data = PenerbitBuku::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('master_data.penerbit.tombol', compact('data'));
                })
                ->make(true);
        }
    }

    /**
     * create page.
     *
     * @return View
     */
    public function create(): View
    {
        return view('master_data.penerbit.create');
    }

    /**
     * Store submitted data to Database.
     *
     * @param PenerbitPostRequest $request
     * @return RedirectResponse
     */
    public function store(PenerbitPostRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $penerbit = new PenerbitBuku($request->safe(
                ['kode_penerbit', 'nama_penerbit']
            ));

            $penerbit->save();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        DB::commit();

        Alert::success('Success', 'Data Penerbir Berhasil Didaftarkan !!!');
        return redirect('/penerbit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PenerbitBuku $penerbit
     * @return View
     */
    public function edit(PenerbitBuku $penerbit): View
    {
        return view('master_data.penerbit.edit', ['penerbit' => $penerbit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PenerbitEditRequest $request
     * @param PenerbitBuku $penerbit
     * @return RedirectResponse
     */
    public function update(PenerbitEditRequest $request, PenerbitBuku $penerbit): RedirectResponse
    {
        DB::transaction(function () use ($request, $penerbit) {
            $penerbit->fill($request->safe(
                ['kode_penerbit', 'nama_penerbit']
            ));

            $penerbit->update();
        });
        Alert::success('Success', 'Data Penerbit Berhasil DiUpdate !!!');

        return redirect('/penerbit');
    }

    /**
     * Delete data.
     *
     * @param PenerbitBuku $penerbit
     * @return JsonResponse
     */
    public function destroy(PenerbitBuku $penerbit): JsonResponse
    {
        PenerbitBuku::destroy($penerbit->id);

        return response()->json(['success' => true, 'message' => 'Data Penerbit berhasil DIHAPUS']);
    }
}
