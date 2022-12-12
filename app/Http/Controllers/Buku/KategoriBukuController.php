<?php

namespace App\Http\Controllers\Buku;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\Kategori\KategoriEditRequest;
use App\Http\Requests\Buku\Kategori\KategoriPostRequest;
use App\Models\Buku\KategoriBuku;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class KategoriBukuController extends Controller
{
    /**
     * Page index
     *
     * @return View
     */
    public function index(): View
    {
        return view('katalog_buku.kategori.index');
    }

    /**
     * Get data from Database for Datatable
     *
     * @param Request $request
     */
    public function getKategori(Request $request)
    {
        if ($request->ajax()) {
            $data = KategoriBuku::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('katalog_buku.kategori.tombol', compact('data'));
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
        return view('katalog_buku.kategori.create');
    }

    /**
     * Store submitted data to Database.
     *
     * @param KategoriPostRequest $request
     * @return RedirectResponse
     */
    public function store(KategoriPostRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $kategori = new kategoriBuku($request->safe(
                ['kode_kategori', 'nama_kategori']
            ));

            $kategori->save();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }
        DB::commit();

        Alert::success('Success', 'Kategori Buku Berhasil Didaftarkan !!!');
        return redirect('/kategori');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param KategoriBuku $kategori
     * @return View
     */
    public function edit(KategoriBuku $kategori): View
    {
        return view('katalog_buku.kategori.edit', ['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KategoriEditRequest $request
     * @param KategoriBuku $kategori
     * @return RedirectResponse
     */
    public function update(KategoriEditRequest $request, KategoriBuku $kategori): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $kategori->fill($request->safe(
                ['kode_kategori', 'nama_kategori']
            ));

            $kategori->saveOrFail();
        } catch (\Exception $e) {
            DB::rollBack();
            $response['message'] = $e->getMessage();
        }

        DB::commit();

        Alert::success('Success', 'Data kategori Berhasil DiUpdate !!!');
        return redirect('/kategori');
    }

    /**
     * Delete data.
     *
     * @param KategoriBuku $kategori
     * @return JsonResponse
     */
    public function destroy(KategoriBuku $kategori): JsonResponse
    {
        KategoriBuku::destroy($kategori->id);

        return response()->json(['success' => true, 'message' => 'Data Kategori berhasil DIHAPUS']);
    }
}
