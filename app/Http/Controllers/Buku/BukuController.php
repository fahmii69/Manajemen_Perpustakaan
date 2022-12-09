<?php

namespace App\Http\Controllers\Buku;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buku\Katalog\BukuEditRequest;
use App\Http\Requests\Buku\Katalog\BukuPostRequest;
use App\Models\Buku\Buku;
use App\Models\Buku\KategoriBuku;
use App\Models\Buku\PenerbitBuku;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class BukuController extends Controller
{
    /**
     * Page index
     *
     * @return View
     */
    public function index(): View
    {
        return view('katalog_buku.buku.index');
    }

    /**
     * get data from database for datatable.
     *
     * @param Request $request
     */
    public function getBuku(Request $request)
    {
        if ($request->ajax()) {
            $data = Buku::latest('id');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('katalog_buku.buku.tombol', compact('data'));
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
        $kategori = KategoriBuku::get();
        $penerbit = PenerbitBuku::get();
        return view('katalog_buku.buku.create', ['kategori' => $kategori, 'penerbit' => $penerbit]);
    }

    /**
     * store data to database.
     *
     * @param BukuPostRequest $request
     * @return RedirectResponse
     */
    public function store(BukuPostRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {

            $buku = new Buku($request->safe(
                ['judul', 'kategori', 'penerbit', 'pengarang', 'tahun_terbit', 'isbn', 'jumlah_buku', 'rak_buku']
            ));

            $buku->save();
        });
        Alert::success('Success', 'Data Buku Berhasil Didaftarkan !!!');
        return redirect('/buku');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Buku $buku
     * @return View
     */
    public function edit(Buku $buku): View
    {
        $kategori = KategoriBuku::get();
        $penerbit = PenerbitBuku::get();
        return view('katalog_buku.buku.edit', ['buku' => $buku, 'kategori' => $kategori, 'penerbit' => $penerbit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BukuEditRequest $request
     * @param Buku $buku
     * @return RedirectResponse
     */
    public function update(BukuEditRequest $request, Buku $buku): RedirectResponse
    {
        DB::transaction(function () use ($request, $buku) {
            $buku->fill($request->safe(
                ['judul', 'kategori', 'penerbit', 'pengarang', 'tahun_terbit', 'isbn', 'jumlah_buku', 'rak_buku']
            ));

            $buku->saveOrFail();
        });
        Alert::success('Success', 'Data buku Berhasil DiUpdate !!!');

        return redirect('/buku');
    }

    /**
     * Delete data.
     *
     * @param Buku $buku
     * @return JsonResponse
     */
    public function destroy(Buku $buku): JsonResponse
    {
        Buku::destroy($buku->id);

        return response()->json(['success' => true, 'message' => 'Data Buku berhasil DIHAPUS']);
    }
}
